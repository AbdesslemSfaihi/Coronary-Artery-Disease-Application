<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SeverityController extends Controller
{
    /*public function predictSeverity(Request $request)
    {
        $inputData = json_decode($request->input('input_data'), true);

        if (!$inputData) {
            return redirect()->route('predict.form')->withErrors(['Invalid input data.']);
        }

        $response = Http::post('http://127.0.0.1:8000/classify', $inputData);

        if (!$response->successful()) {
            return back()->withErrors(['Error from severity API: ' . $response->body()]);
        }

        $severityResult = $response->json();

        return view('severity-result', ['severity' => $severityResult]);
    }*/

    public function predictSeverity(Request $request)
    {
        $inputData = json_decode($request->input('input_data'), true);

        if (!$inputData) {
            return redirect()->route('predict.form')->withErrors(['Invalid input data.']);
        }

        // MOCK RESPONSE (remove this when your model is running)
        $severityResult = [
            'stage' => 'Moderate',
            'confidence' => '82%'
        ];

        return view('coro-severity-result', ['severity' => $severityResult]);
    }
}
