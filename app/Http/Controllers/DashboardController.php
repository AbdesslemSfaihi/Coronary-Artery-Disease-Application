<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller implements ToCollection, WithHeadingRow
{
    protected $ageBins;
    protected $coroResults;
    protected $totalPatients = 0;
    protected $userCount = 0;


    public function collection(Collection $rows)
    {
        // Initialize bins
        $this->ageBins = [
            '0-20' => 0,
            '21-40' => 0,
            '41-60' => 0,
            '61-80' => 0,
            '81+' => 0
        ];

        $this->coroResults = [
            'No Coronary Disease (0)' => 0,
            'Coronary Disease (1)' => 0
        ];

        $this->totalPatients = $rows->count();

        // Log headers and first few rows for debugging
        Log::info('Excel Headers:', $rows->first()->keys()->toArray());
        Log::info('First 3 Rows:', $rows->take(3)->toArray());

        if ($rows->isEmpty()) {
            Log::warning('No rows found in Excel file.');
            return;
        }

        foreach ($rows as $index => $row) {
            // Process Age
            if (isset($row['age']) && is_numeric($row['age']) && $row['age'] >= 0) {
                $age = (int) $row['age'];
                if ($age <= 20) {
                    $this->ageBins['0-20']++;
                } elseif ($age <= 40) {
                    $this->ageBins['21-40']++;
                } elseif ($age <= 60) {
                    $this->ageBins['41-60']++;
                } elseif ($age <= 80) {
                    $this->ageBins['61-80']++;
                } else {
                    $this->ageBins['81+']++;
                }
            }

            // Process Coro résultat (flexible header matching)
            $coroValue = null;
            $coroHeader = null;
            foreach (
                [
                    'Coro résultat',
                    'Coro Resultat',
                    'coro_resultat',
                    'Coro',
                    'coronary_result',
                    'Coronary',
                    'Coronary_Result',
                    'Coronary Result',
                    'coro result',
                    'Result'
                ] as $possibleHeader
            ) {
                if (isset($row[$possibleHeader])) {
                    $coroValue = $row[$possibleHeader];
                    $coroHeader = $possibleHeader;
                    break;
                }
            }

            // Log row if no coro value found
            if ($coroValue === null) {
                Log::warning("No coronary result column found in row {$index}:", $row->toArray());
                continue;
            }

            // Log raw value and type for debugging
            Log::info("Coro value in row {$index} (Header: {$coroHeader}):", [
                'value' => $coroValue,
                'type' => gettype($coroValue)
            ]);

            // Normalize value to string and handle multiple formats
            $coroValue = is_null($coroValue) ? '' : (string) $coroValue;
            $coroValue = strtolower(trim($coroValue)); // Normalize case and trim whitespace

            if (in_array($coroValue, ['0', '0.0', 'false', 'no', ''], true)) {
                $this->coroResults['No Coronary Disease (0)']++;
            } elseif (in_array($coroValue, ['1', '1.0', 'true', 'yes'], true)) {
                $this->coroResults['Coronary Disease (1)']++;
            } else {
                Log::warning("Invalid coro value in row {$index} (Header: {$coroHeader}): {$coroValue}");
            }
        }

        // Log processed data
        Log::info('Processed Age Bins:', $this->ageBins);
        Log::info('Processed Coro Results:', $this->coroResults);
    }

    public function headingRow(): int
    {
        return 1; // Use the first row as headers
    }

    public function index()
    {
        try {
            $filePath = storage_path('app/public/dataFINALE.xlsx');
            if (!file_exists($filePath)) {
                throw new \Exception('Excel file not found at: ' . $filePath);
            }
            Excel::import($this, $filePath);
        } catch (\Exception $e) {
            Log::error('Excel import failed: ' . $e->getMessage());

            $this->userCount = \App\Models\User::count();

            return view('dash', [
                'ageBinsJson' => json_encode($this->ageBins),
                'coroResultsJson' => json_encode($this->coroResults),
                'totalPatients' => $this->totalPatients,
                'coronaryPositive' => $this->coroResults['Coronary Disease (1)'],
                'coronaryNegative' => $this->coroResults['No Coronary Disease (0)'],
                'userCount' => $this->userCount,
            ]);
        }

        // Fallback to dummy data if no valid coro results
        if ($this->coroResults['No Coronary Disease (0)'] === 0 && $this->coroResults['Coronary Disease (1)'] === 0) {
            Log::warning('No valid coronary result data processed. Using dummy data.');
            $this->coroResults = [
                'No Coronary Disease (0)' => 50,
                'Coronary Disease (1)' => 30
            ];
        }

        return view('dash', [
            'ageBinsJson' => json_encode($this->ageBins),
            'coroResultsJson' => json_encode($this->coroResults),
            'totalPatients' => $this->totalPatients,
            'coronaryPositive' => $this->coroResults['Coronary Disease (1)'],
            'coronaryNegative' => $this->coroResults['No Coronary Disease (0)'],
            'userCount' => \App\Models\User::where('role', 'user')->count(),
        ]);
    }

    public function patients()
    {
        try {
            $filePath = storage_path('app/public/dataFINALE.xlsx');

            if (!file_exists($filePath)) {
                throw new \Exception('Excel file not found at: ' . $filePath);
            }

            $data = Excel::toCollection(null, $filePath)[0]; // Get first sheet

            return view('patients', ['patients' => $data]);
        } catch (\Exception $e) {
            Log::error('Error loading patients data: ' . $e->getMessage());
            return back()->withErrors('Failed to load patient data.');
        }
    }
}
