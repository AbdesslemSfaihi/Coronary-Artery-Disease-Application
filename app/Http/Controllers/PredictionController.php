<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use App\Models\PredictionResult;
use thiagoalessio\TesseractOCR\TesseractOCR;



class PredictionController extends Controller
{
    protected $steps = [1, 2, 3, 4, 5];

    public function showForm($step = 1)
    {
        if (!in_array($step, $this->steps)) {
            return redirect()->route('predict.form', ['step' => 1]);
        }

        $completed = Session::get('completed_steps', []);

        // ✅ Block if previous step is not completed
        if ($step > 1 && !in_array($step - 1, $completed)) {
            return redirect()->route('predict.form', ['step' => $step - 1])
                ->with('error', 'Please complete the previous step first.');
        }

        $data = Session::get("form_step_$step", []);
        $completedSteps = Session::get('completed_steps', []);

        return view("predict-form-step$step", compact('step', 'data', 'completedSteps'));
    }



    public function submitForm(Request $request, $step)
    {
        $validated = $request->validate($this->rulesForStep($step));
        Session::put("form_step_$step", $validated);

        $completed = Session::get('completed_steps', []);
        if (!in_array($step, $completed)) {
            $completed[] = $step;
            Session::put('completed_steps', $completed);
        }

        $currentIndex = array_search($step, $this->steps);
        $nextStep = $this->steps[$currentIndex + 1] ?? null;

        if ($nextStep) {
            return redirect()->route('predict.form', ['step' => $nextStep]);
        }

        // Final step reached — merge all session data
        $allData = collect($this->steps)->flatMap(fn($s) => Session::get("form_step_$s", []))->toArray();

        // Clean numeric inputs (commas, strings, etc.)
        foreach ($allData as $key => $value) {
            if (is_string($value)) {
                $value = str_replace(',', '.', $value);
                if (is_numeric($value)) {
                    $allData[$key] = strpos($value, '.') !== false ? (float) $value : (int) $value;
                }
            }
        }

        $payload = [
            'data' => [
                'Age' => $allData['Age'],
                'Antécédants médicaux_BPCO ' => $allData['Antécédants_médicaux_BPCO'],  // trailing space
                'Antécédants médicaux_Diabète ancienneté' => $allData['Antécédants_médicaux_Diabète_ancienneté'],
                'Antécédants médicaux_HTA' => $allData['Antécédants_médicaux_HTA'],
                'Antécédants médicaux_HTA _HVG électrique ' => $allData['Antécédants_médicaux_HTA_HVG_électrique'], // trailing space
                'Antécédants médicaux_HTA_ancienneté' => $allData['Antécédants_médicaux_HTA_ancienneté'],
                'Antécédants médicaux_IMC_classe' => $allData['Antécédants_médicaux_IMC_classe'],
                'Antécédants médicaux_insuffisance rénale_ancienneté' => $allData['Antécédants_médicaux_insuffisance_rénale_ancienneté'],
                'Biologie_CRP' => $allData['Biologie_CRP'],
                'Biologie_ClasseMDRD' => $allData['Biologie_ClasseMDRD'],
                'Biologie_GAJ' => $allData['Biologie_GAJ'],
                'Biologie_HDL-C' => $allData['Biologie_HDL-C'],
                'Biologie_HbA1C' => $allData['Biologie_HbA1C'],
                'Biologie_Non HDL' => $allData['Biologie_Non_HDL'],
                'ECG_ End of ST segment amplitudes (mv)' => $allData['ECG_End_ST_amplitude'],
                'ECG_Intervalle PR (ms)' => $allData['ECG_PR_interval'],
                'ECG_Middle of ST segment amplitudes (mv)' => $allData['ECG_Mid_ST_amplitude'],
                'ECG_Poor R wave progression' => $allData['ECG_Poor_R_wave_progression'],
                'ECG_Premature ventricular contractions' => $allData['ECG_PVC'],
                'ECG_Q wave' => $allData['ECG_Q_wave'],
                'ECG_QRS duration (ms)' => $allData['ECG_QRS_duration'],
                'ECG_QRS fragmentation' => $allData['ECG_QRS_fragmentation'],
                'ECG_T-peak-to-end time (TPE; ms)' => $allData['ECG_TPE'],
                'Habitudes_Tabagisme ' => $allData['Habitudes_Tabagisme'],  // trailing space
                'Habitudes_Tabgisme_ancien' => $allData['Habitudes_Tabagisme_ancien'],
                'Sexe' => $allData['Sexe'],
                'Symptomes_Douleur' => $allData['Symptomes_Douleur'],
                'Symptomes_douleur_déclenchement' => $allData['Symptomes_Douleur_déclenchement'],
            ]
        ];


        Session::put('input_data', $payload['data']);

        try {
            $response = Http::post('http://127.0.0.1:8000/predict', $payload);

            $result = $response->json(); // ✅ Save the result

            if (!$response->successful()) {
                return back()->withErrors(['API Error: ' . $response->body()]);
            }

            Session::put('result', $result); // ✅ Save result to session

            // ✅ Prepare the correct DB field names (match table columns!)
            $dataForDB = [
                'Age' => $allData['Age'],
                'Sexe' => $allData['Sexe'],
                'Antécédants_médicaux_BPCO' => $allData['Antécédants_médicaux_BPCO'],
                'Antécédants_médicaux_Diabète_ancienneté' => $allData['Antécédants_médicaux_Diabète_ancienneté'],
                'Antécédants_médicaux_HTA' => $allData['Antécédants_médicaux_HTA'],
                'Antécédants_médicaux_HTA_HVG_électrique' => $allData['Antécédants_médicaux_HTA_HVG_électrique'],
                'Antécédants_médicaux_HTA_ancienneté' => $allData['Antécédants_médicaux_HTA_ancienneté'],
                'Antécédants_médicaux_IMC_classe' => $allData['Antécédants_médicaux_IMC_classe'],
                'Antécédants_médicaux_insuffisance_rénale_ancienneté' => $allData['Antécédants_médicaux_insuffisance_rénale_ancienneté'],
                'Biologie_CRP' => $allData['Biologie_CRP'],
                'Biologie_ClasseMDRD' => $allData['Biologie_ClasseMDRD'],
                'Biologie_GAJ' => $allData['Biologie_GAJ'],
                'Biologie_HDL-C' => $allData['Biologie_HDL-C'],
                'Biologie_HbA1C' => $allData['Biologie_HbA1C'],
                'Biologie_Non_HDL' => $allData['Biologie_Non_HDL'],
                'ECG_End_ST_amplitude' => $allData['ECG_End_ST_amplitude'],
                'ECG_PR_interval' => $allData['ECG_PR_interval'],
                'ECG_Mid_ST_amplitude' => $allData['ECG_Mid_ST_amplitude'],
                'ECG_Poor_R_wave_progression' => $allData['ECG_Poor_R_wave_progression'],
                'ECG_PVC' => $allData['ECG_PVC'],
                'ECG_Q_wave' => $allData['ECG_Q_wave'],
                'ECG_QRS_duration' => $allData['ECG_QRS_duration'],
                'ECG_QRS_fragmentation' => $allData['ECG_QRS_fragmentation'],
                'ECG_TPE' => $allData['ECG_TPE'],
                'Habitudes_Tabagisme' => $allData['Habitudes_Tabagisme'],
                'Habitudes_Tabagisme_ancien' => $allData['Habitudes_Tabagisme_ancien'],
                'Symptomes_Douleur' => $allData['Symptomes_Douleur'],
                'Symptomes_Douleur_déclenchement' => $allData['Symptomes_Douleur_déclenchement'],
                'prediction' => $result['prediction'] ?? null,
            ];


            // PredictionResult::create($dataForDB);

            // ✅ Save to database
            PredictionResult::create($dataForDB);

            // ✅ Clear session
            foreach ($this->steps as $s) {
                Session::forget("form_step_$s");
            }
            Session::forget('input_data');

            // ✅ Redirect to result view
            return redirect()->route('predict.result');
        } catch (\Exception $e) {
            return back()->withErrors(['Exception: ' . $e->getMessage()]);
        }
    }


    public function extractFromImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $imagePath = $request->file('image')->getPathname();

        $text = (new TesseractOCR($imagePath))
            ->executable('C:/Program Files/Tesseract-OCR/tesseract.exe')
            ->run();

        $fieldMap = [
            'PR' => 'ECG_PR_interval',
            'QRS' => 'ECG_QRS_duration',
            'RV5/SV1' => 'ECG_End_ST_amplitude',
            'Mid ST' => 'ECG_Mid_ST_amplitude',
            'TPE' => 'ECG_TPE'
        ];

        $extracted = [];

        foreach ($fieldMap as $keyword => $fieldName) {
            // Normalize the OCR text
            $text = str_replace(['‘', '’', '“', '”'], "'", $text);
            $text = preg_replace('/[“”]/u', '"', $text); // just in case
            $text = preg_replace('/\s+/', ' ', $text);   // normalize whitespace
            $value = $this->extractValue($keyword, $text);
            if ($value !== null) {
                $extracted[$fieldName] = $value;
            }
        }

        // ✅ Merge with existing values
        $existing = Session::get("form_step_4", []);
        $merged = array_merge($existing, $extracted);
        Session::put("form_step_4", $merged);



        return redirect()->route('predict.form', ['step' => 5])
            ->with('success', 'Some values were auto-filled from the image. Please complete the rest manually.');
    }


    // Helper to extract numeric value based on a keyword
    private function extractValue(string $label, string $text): ?float
    {
        // Match: 'PR' => '150' or "PR" => "150"
        $pattern = "/[\"']?" . preg_quote($label, '/') . "[\"']?\s*=>\s*[\"']?([\d]+(?:[.,]\d+)?)/i";

        if (preg_match($pattern, $text, $matches)) {
            return (float) str_replace(',', '.', $matches[1]);
        }

        return null;
    }







    public function showResult()
    {
        $result = session('result');
        $inputData = session('input_data');

        if (!$result) {
            return redirect()->route('predict.form')->withErrors(['No prediction result found.']);
        }

        return view('predict-result', ['result' => $result, 'inputData' => $inputData]);
    }

    private function rulesForStep($step)
    {
        return match ((int)$step) {
            1 => [
                'Age' => 'required|numeric|min:1|max:120',
                'Sexe' => 'required|in:0,1',
                'Antécédants_médicaux_BPCO' => 'required|in:0,1',
                'Antécédants_médicaux_IMC_classe' => 'required|numeric|min:0|max:4',
            ],
            2 => [
                'Antécédants_médicaux_HTA' => 'required|in:0,1',
                'Antécédants_médicaux_HTA_HVG_électrique' => 'required|in:0,1',
                'Antécédants_médicaux_HTA_ancienneté' => 'required|numeric|min:0|max:100',
                'Antécédants_médicaux_Diabète_ancienneté' => 'required|numeric|min:0|max:100',
                'Antécédants_médicaux_insuffisance_rénale_ancienneté' => 'required|numeric|min:0|max:50',
            ],
            3 => [
                'Habitudes_Tabagisme' => 'required|in:0,1',
                'Habitudes_Tabagisme_ancien' => 'required|in:0,1',
                'Symptomes_Douleur' => 'required|in:0,1',
                'Symptomes_Douleur_déclenchement' => 'required|in:0,1',
            ],
            4 => [
                'Biologie_CRP' => 'required|numeric|min:0',
                'Biologie_ClasseMDRD' => 'required|numeric|min:0|max:6',
                'Biologie_GAJ' => 'required|numeric|min:0',
                'Biologie_HDL-C' => 'required|numeric|min:0',
                'Biologie_HbA1C' => 'required|numeric|min:0',
                'Biologie_Non_HDL' => 'required|numeric|min:0',
            ],
            5 => [
                'ECG_End_ST_amplitude' => 'required|numeric',
                'ECG_PR_interval' => 'required|numeric',
                'ECG_Mid_ST_amplitude' => 'required|numeric',
                'ECG_Poor_R_wave_progression' => 'required|in:0,1',
                'ECG_PVC' => 'required|in:0,1',
                'ECG_Q_wave' => 'required|in:0,1',
                'ECG_QRS_duration' => 'required|numeric',
                'ECG_QRS_fragmentation' => 'required|in:0,1',
                'ECG_TPE' => 'required|numeric',
            ],
            default => [],
        };
    }
}
