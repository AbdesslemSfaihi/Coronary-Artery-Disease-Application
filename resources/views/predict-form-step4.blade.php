<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Step 3 - Biological Markers</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #7c3aed;
            --primary-light: #a78bfa;
            --primary-hover: #6d28d9;
            --success: #10b981;
            --error: #ef4444;
            --warning: #f59e0b;
            --info: #3b82f6;
            --border: #e2e8f0;
            --focus-ring: rgba(124, 58, 237, 0.3);
            --card-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            --normal-range: #4ade80;
            --abnormal-range: #ef4444;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f3f4f6 0%, #f9fafb 100%);
            padding: 20px;
            color: #1f2937;
            min-height: 100vh;
        }

        .form-container {
            max-width: 840px;
            margin: 2rem auto;
            background: white;
            padding: 2.5rem;
            border-radius: 16px;
            box-shadow: var(--card-shadow);
            position: relative;
            overflow: hidden;
        }

        .form-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 8px;
            height: 100%;
            background: linear-gradient(to bottom, var(--primary), var(--primary-light));
        }

        .form-header {
            text-align: center;
            margin-bottom: 2rem;
            position: relative;
        }

        .form-title {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .form-title i {
            font-size: 1.5rem;
        }

        .form-step {
            color: #64748b;
            font-size: 0.875rem;
            font-weight: 500;
            background: #f1f5f9;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            display: inline-block;
        }

        .form-group {
            margin-bottom: 1.75rem;
            position: relative;
        }

        .form-section {
            margin-bottom: 2.5rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px dashed #e2e8f0;
        }

        .form-section-title {
            font-size: 1.25rem;
            color: var(--primary);
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .form-section-title i {
            width: 30px;
            text-align: center;
        }

        label {
            font-weight: 600;
            display: block;
            margin-bottom: 0.75rem;
            color: #334155;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        label i {
            color: var(--primary);
            width: 24px;
            text-align: center;
            font-size: 1.1rem;
        }

        .input-hint {
            font-size: 0.75rem;
            color: #64748b;
            margin-top: 0.5rem;
            margin-left: 32px;
            line-height: 1.4;
        }

        input,
        select {
            width: 100%;
            padding: 0.875rem 1rem 0.875rem 3rem;
            border: 2px solid var(--border);
            border-radius: 10px;
            font-size: 1rem;
            transition: all 0.3s;
            background-color: #fff;
            color: #334155;
        }

        input:focus,
        select:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 4px var(--focus-ring);
        }

        input:hover,
        select:hover {
            border-color: var(--primary-light);
        }

        .input-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 1.1rem;
            width: 24px;
            text-align: center;
        }

        .unit-display {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #64748b;
            font-size: 0.875rem;
            font-weight: 500;
        }

        .error {
            color: var(--error);
            font-size: 0.875rem;
            margin-top: 0.5rem;
            display: flex;
            align-items: center;
            gap: 5px;
            margin-left: 32px;
        }

        .error i {
            font-size: 1rem;
        }

        .form-footer {
            display: flex;
            justify-content: space-between;
            margin-top: 3rem;
        }

        .btn {
            color: white;
            padding: 0.875rem 2rem;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        .btn-next {
            background: linear-gradient(to right, var(--primary), var(--primary-light));
            margin-left: auto;
        }

        .btn-prev {
            background: linear-gradient(to right, #64748b, #94a3b8);
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        .btn:active {
            transform: translateY(0);
        }

        .progress-container {
            margin-bottom: 2.5rem;
            position: relative;
        }

        .progress-text {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.5rem;
            font-size: 0.875rem;
            color: #64748b;
            font-weight: 500;
        }

        .progress-bar {
            height: 8px;
            background-color: #e2e8f0;
            border-radius: 4px;
            overflow: hidden;
        }

        .progress {
            height: 100%;
            background: linear-gradient(to right, var(--primary), var(--primary-light));
            width: 60%;
            transition: width 0.6s ease;
        }

        /* Enhanced Input Styles */
        .value-controls {
            display: flex;
            gap: 1rem;
            margin-top: 0.5rem;
        }

        .value-slider {
            flex-grow: 1;
            -webkit-appearance: none;
            height: 8px;
            border-radius: 4px;
            background: #e2e8f0;
            outline: none;
        }

        .value-slider::-webkit-slider-thumb {
            -webkit-appearance: none;
            appearance: none;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: var(--primary);
            cursor: pointer;
            transition: all 0.2s;
        }

        .value-slider::-webkit-slider-thumb:hover {
            transform: scale(1.2);
            background: var(--primary-hover);
        }

        .value-display {
            min-width: 80px;
            text-align: center;
            font-weight: 600;
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .range-indicator {
            display: flex;
            align-items: center;
            gap: 5px;
            margin-top: 0.25rem;
        }

        .normal-indicator {
            color: var(--normal-range);
            font-weight: 600;
        }

        .abnormal-indicator {
            color: var(--abnormal-range);
            font-weight: 600;
        }

        .range-visual {
            height: 6px;
            border-radius: 3px;
            background: linear-gradient(to right, var(--normal-range), var(--abnormal-range));
            margin: 0.5rem 0;
            position: relative;
        }

        .range-marker {
            position: absolute;
            top: -5px;
            width: 2px;
            height: 16px;
            background-color: #64748b;
        }

        .range-label {
            position: absolute;
            top: 12px;
            transform: translateX(-50%);
            font-size: 0.75rem;
            color: #64748b;
        }

        .current-value-marker {
            position: absolute;
            top: -8px;
            width: 0;
            height: 0;
            border-left: 8px solid transparent;
            border-right: 8px solid transparent;
            border-top: 12px solid var(--primary);
            transform: translateX(-50%);
        }

        /* MDRD Classification Selector */
        .mdr-options {
            display: flex;
            gap: 0.5rem;
            margin-top: 0.5rem;
        }

        .mdr-option {
            flex: 1;
            text-align: center;
        }

        .mdr-input {
            position: absolute;
            opacity: 0;
            width: 0;
            height: 0;
        }

        .mdr-label {
            display: block;
            padding: 0.75rem 0.5rem;
            border: 2px solid var(--border);
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s;
            font-weight: 500;
            background-color: #fff;
        }

        .mdr-input:checked+.mdr-label {
            border-color: var(--primary);
            background-color: #f5f3ff;
            color: var(--primary);
            font-weight: 600;
        }

        .mdr-input:focus+.mdr-label {
            box-shadow: 0 0 0 4px var(--focus-ring);
        }

        .mdr-option:hover .mdr-label {
            border-color: var(--primary-light);
        }

        @media (max-width: 768px) {
            .form-container {
                padding: 1.75rem;
            }

            .mdr-options {
                flex-wrap: wrap;
            }

            .mdr-option {
                flex: 1 0 calc(50% - 0.5rem);
            }

            .value-controls {
                flex-direction: column;
            }
        }

        /* Animation */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .form-group {
            animation: fadeIn 0.4s ease forwards;
        }

        .form-group:nth-child(1) {
            animation-delay: 0.1s;
        }

        .form-group:nth-child(2) {
            animation-delay: 0.2s;
        }

        .form-group:nth-child(3) {
            animation-delay: 0.3s;
        }

        .form-group:nth-child(4) {
            animation-delay: 0.4s;
        }

        .form-group:nth-child(5) {
            animation-delay: 0.5s;
        }

        .form-group:nth-child(6) {
            animation-delay: 0.6s;
        }


        .progress-container {
            margin-bottom: 2.5rem;
            padding: 0 1rem;
        }

        .bubble-nav {
            display: flex;
            justify-content: space-between;
            position: relative;
            margin: 0 auto;
            max-width: 800px;
        }

        .bubble {
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
            z-index: 2;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .bubble-number {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background-color: #e2e8f0;
            color: #64748b;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            transition: all 0.3s ease;
            margin-bottom: 0.5rem;
        }

        .bubble-label {
            font-size: 0.75rem;
            color: #64748b;
            font-weight: 500;
            text-align: center;
            max-width: 80px;
            transition: all 0.3s ease;
        }

        .bubble.active .bubble-number {
            background: linear-gradient(to right, var(--primary), var(--primary-light));
            color: white;
            transform: scale(1.1);
        }

        .bubble.active .bubble-label {
            color: var(--primary);
            font-weight: 600;
        }

        .progress-line {
            position: absolute;
            top: 18px;
            left: 0;
            right: 0;
            height: 4px;
            background-color: #e2e8f0;
            z-index: 1;
        }

        /* Connect the bubbles with a line */
        .bubble:not(:last-child)::after {
            content: '';
            position: absolute;
            top: 18px;
            left: 50%;
            width: 100%;
            height: 4px;
            background-color: #e2e8f0;
            z-index: -1;
            transform: translateX(18px);
        }

        .bubble.active~.bubble::after,
        .bubble.active~.bubble .bubble-number {
            background-color: #e2e8f0;
        }

        /* For completed steps */
        .bubble.completed .bubble-number {
            background-color: var(--primary-light);
            color: white;
        }

        .bubble.completed .bubble-label {
            color: var(--primary);
        }

        @media (max-width: 768px) {
            .bubble-label {
                font-size: 0.65rem;
                max-width: 60px;
            }

            .bubble-number {
                width: 30px;
                height: 30px;
                font-size: 0.875rem;
            }

            .bubble:not(:last-child)::after {
                top: 15px;
            }
        }

        .bubble-nav a {
            text-decoration: none;
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
            z-index: 2;
        }
    </style>
</head>

<body>
    <div class="form-container">
        <div class="form-header">
            <div class="form-title">
                <i class="fas fa-flask"></i>
                Biological Markers
            </div>
            <br>
            <div class="progress-container">
                <div class="bubble-nav">
                    <a href="{{ route('predict.form', ['step' => 1]) }}"
                        class="bubble {{ $step == 1 ? 'active' : '' }} {{ $step > 1 ? 'completed' : '' }}"
                        data-step="1">
                        <div class="bubble-number">1</div>
                        <div class="bubble-label">General Info</div>
                    </a>
                    <a href="{{ route('predict.form', ['step' => 2]) }}"
                        class="bubble {{ $step == 2 ? 'active' : '' }} {{ $step > 2 ? 'completed' : '' }}"
                        data-step="2">
                        <div class="bubble-number">2</div>
                        <div class="bubble-label">Medical History</div>
                    </a>
                    <a href="{{ route('predict.form', ['step' => 3]) }}"
                        class="bubble {{ $step == 3 ? 'active' : '' }} {{ $step > 3 ? 'completed' : '' }}"
                        data-step="3">
                        <div class="bubble-number">3</div>
                        <div class="bubble-label">Habits & Symptoms</div>
                    </a>
                    <a href="{{ route('predict.form', ['step' => 4]) }}"
                        class="bubble {{ $step == 4 ? 'active' : '' }} {{ $step > 4 ? 'completed' : '' }}"
                        data-step="4">
                        <div class="bubble-number">4</div>
                        <div class="bubble-label">Biological Markers</div>
                    </a>
                    <a href="{{ route('predict.form', ['step' => 5]) }}"
                        class="bubble {{ $step == 5 ? 'active' : '' }}"
                        data-step="5">
                        <div class="bubble-number">5</div>
                        <div class="bubble-label">ECG Results</div>
                    </a>
                    <div class="progress-line"></div>
                </div>
            </div>
        </div>

        <form method="POST" action="{{ route('predict.submit', ['step' => $step]) }}">
            @csrf

            <div class="form-section">
                <div class="form-section-title">
                    <i class="fas fa-vial"></i>
                    Blood Test Results
                </div>

                <div class="form-group">
                    <label for="Biologie_CRP">
                        <i class="fas fa-tint"></i>
                        C-Reactive Protein (CRP)
                    </label>
                    <div class="value-controls">
                        <input type="range" class="value-slider" id="crpSlider" min="0" max="50" step="1"
                            value="{{ old('Biologie_CRP', $data['Biologie_CRP'] ?? '5') }}">
                        <span class="value-display" id="crpValue">
                            {{ old('Biologie_CRP', $data['Biologie_CRP'] ?? '5') }} <small>mg/L</small>
                        </span>
                    </div>
                    <div class="range-visual">
                        <div class="range-marker" style="left: 20%;"></div>
                        <div class="range-label" style="left: 20%;">Normal</div>
                        <div class="range-marker" style="left: 80%;"></div>
                        <div class="range-label" style="left: 80%;">High</div>
                        <div class="current-value-marker" id="crpMarker"
                            style="left: {{ ((old('Biologie_CRP', $data['Biologie_CRP'] ?? 5) / 50) * 100) }}%;"></div>
                    </div>
                    <input type="hidden" name="Biologie_CRP" id="Biologie_CRP"
                        value="{{ old('Biologie_CRP', $data['Biologie_CRP'] ?? '5') }}">
                    <br>
                    <div class="input-hint">
                        CRP is a marker of inflammation in the body.
                        <span id="crpAssessment">
                            @php
                            $crpValue = old('Biologie_CRP', $data['Biologie_CRP'] ?? 5);
                            if ($crpValue < 10) {
                                echo '<span class="normal-indicator"><i class="fas fa-check-circle"></i> Normal (below 10 mg/L)</span>' ;
                                } else {
                                echo '<span class="abnormal-indicator"><i class="fas fa-exclamation-triangle"></i> Elevated (≥10 mg/L)</span>' ;
                                }
                                @endphp
                                </span>
                    </div>
                    @error('Biologie_CRP')
                    <div class="error">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                

            <div class="form-group">
                <label for="Biologie_GAJ">
                    <i class="fas fa-candy-cane"></i>
                    Fasting Blood Glucose
                </label>
                <div class="value-controls">
                    <input type="range" class="value-slider" id="glucoseSlider" min="2" max="20" step="0.1"
                        value="{{ old('Biologie_GAJ', $data['Biologie_GAJ'] ?? '5') }}">
                    <span class="value-display" id="glucoseValue">
                        {{ old('Biologie_GAJ', $data['Biologie_GAJ'] ?? '5') }} <small>mmol/L</small>
                    </span>
                </div>
                <div class="range-visual">
                    <div class="range-marker" style="left: 15%;"></div>
                    <div class="range-label" style="left: 15%;">Low</div>
                    <div class="range-marker" style="left: 27.5%;"></div>
                    <div class="range-label" style="left: 27.5%;">Normal</div>
                    <div class="range-marker" style="left: 40%;"></div>
                    <div class="range-label" style="left: 40%;">Prediabetes</div>
                    <div class="range-marker" style="left: 55%;"></div>
                    <div class="range-label" style="left: 55%;">Diabetes</div>
                    <div class="current-value-marker" id="glucoseMarker"
                        style="left: {{ ((old('Biologie_GAJ', $data['Biologie_GAJ'] ?? 5) - 2) / 18) * 100 }}%;"></div>
                </div>
                <input type="hidden" name="Biologie_GAJ" id="Biologie_GAJ"
                    value="{{ old('Biologie_GAJ', $data['Biologie_GAJ'] ?? '5') }}">
                <br>
                <div class="input-hint">
                    <span id="glucoseAssessment">
                        @php
                        $glucoseValue = old('Biologie_GAJ', $data['Biologie_GAJ'] ?? 5);
                        if ($glucoseValue < 3.9) {
                            echo '<span class="abnormal-indicator"><i class="fas fa-exclamation-triangle"></i> Hypoglycemic (<3.9 mmol/L)</span>' ;
                            } elseif ($glucoseValue < 5.5) {
                            echo '<span class="normal-indicator"><i class="fas fa-check-circle"></i> Normal (3.9-5.5 mmol/L)</span>' ;
                            } elseif ($glucoseValue < 7.0) {
                            echo '<span class="abnormal-indicator"><i class="fas fa-exclamation-triangle"></i> Prediabetes (5.5-7.0 mmol/L)</span>' ;
                            } else {
                            echo '<span class="abnormal-indicator"><i class="fas fa-exclamation-triangle"></i> Diabetes (≥7.0 mmol/L)</span>' ;
                            }
                            @endphp
                            </span>
                </div>
                @error('Biologie_GAJ')
                <div class="error">
                    <i class="fas fa-exclamation-circle"></i>
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="Biologie_HDL-C">
                    <i class="fas fa-heartbeat"></i>
                    HDL Cholesterol
                </label>
                <div class="value-controls">
                    <input type="range" class="value-slider" id="hdlSlider" min="0" max="3" step="0.1"
                        value="{{ old('Biologie_HDL-C', $data['Biologie_HDL-C'] ?? '1.2') }}">
                    <span class="value-display" id="hdlValue">
                        {{ old('Biologie_HDL-C', $data['Biologie_HDL-C'] ?? '1.2') }} <small>mmol/L</small>
                    </span>
                </div>
                <div class="range-visual">
                    <div class="range-marker" style="left: 33.3%;"></div>
                    <div class="range-label" style="left: 33.3%;">Men: ≥1.0</div>
                    <div class="range-marker" style="left: 43.3%;"></div>
                    <div class="range-label" style="left: 43.3%;">Women: ≥1.3</div>
                    <div class="current-value-marker" id="hdlMarker"
                        style="left: {{ ((old('Biologie_HDL-C', $data['Biologie_HDL-C'] ?? 1.2) / 3) * 100) }}%;"></div>
                </div>
                <input type="hidden" name="Biologie_HDL-C" id="Biologie_HDL-C"
                    value="{{ old('Biologie_HDL-C', $data['Biologie_HDL-C'] ?? '1.2') }}">
                <br>
                <div class="input-hint">
                    HDL is the "good" cholesterol.
                    <span id="hdlAssessment">
                        @php
                        $hdlValue = old('Biologie_HDL-C', $data['Biologie_HDL-C'] ?? 1.2);
                        if ($hdlValue >= 1.3) {
                        echo '<span class="normal-indicator"><i class="fas fa-check-circle"></i> Optimal (≥1.3 mmol/L)</span>';
                        } elseif ($hdlValue >= 1.0) {
                        echo '<span class="normal-indicator"><i class="fas fa-check-circle"></i> Acceptable (≥1.0 mmol/L)</span>';
                        } else {
                        echo '<span class="abnormal-indicator"><i class="fas fa-exclamation-triangle"></i> Low (<1.0 mmol/L)</span>';
                                }
                                @endphp
                        </span>
                </div>
                @error('Biologie_HDL-C')
                <div class="error">
                    <i class="fas fa-exclamation-circle"></i>
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="Biologie_HbA1C">
                    <i class="fas fa-chart-line"></i>
                    Hemoglobin A1C
                </label>
                <div class="value-controls">
                    <input type="range" class="value-slider" id="hba1cSlider" min="4" max="12" step="0.1"
                        value="{{ old('Biologie_HbA1C', $data['Biologie_HbA1C'] ?? '5.5') }}">
                    <span class="value-display" id="hba1cValue">
                        {{ old('Biologie_HbA1C', $data['Biologie_HbA1C'] ?? '5.5') }} <small>%</small>
                    </span>
                </div>
                <div class="range-visual">
                    <div class="range-marker" style="left: 21.25%;"></div>
                    <div class="range-label" style="left: 21.25%;">Normal</div>
                    <div class="range-marker" style="left: 31.25%;"></div>
                    <div class="range-label" style="left: 31.25%;">Prediabetes</div>
                    <div class="range-marker" style="left: 43.75%;"></div>
                    <div class="range-label" style="left: 43.75%;">Diabetes</div>
                    <div class="current-value-marker" id="hba1cMarker"
                        style="left: {{ ((old('Biologie_HbA1C', $data['Biologie_HbA1C'] ?? 5.5) - 4) / 8) * 100 }}%;"></div>
                </div>
                <input type="hidden" name="Biologie_HbA1C" id="Biologie_HbA1C"
                    value="{{ old('Biologie_HbA1C', $data['Biologie_HbA1C'] ?? '5.5') }}">
                <br>
                <div class="input-hint">
                    HbA1C reflects average blood sugar over 2-3 months.
                    <span id="hba1cAssessment">
                        @php
                        $hba1cValue = old('Biologie_HbA1C', $data['Biologie_HbA1C'] ?? 5.5);
                        if ($hba1cValue < 5.7) {
                            echo '<span class="normal-indicator"><i class="fas fa-check-circle"></i> Normal (<5.7%)</span>' ;
                            } elseif ($hba1cValue < 6.5) {
                            echo '<span class="abnormal-indicator"><i class="fas fa-exclamation-triangle"></i> Prediabetes (5.7-6.4%)</span>' ;
                            } else {
                            echo '<span class="abnormal-indicator"><i class="fas fa-exclamation-triangle"></i> Diabetes (≥6.5%)</span>' ;
                            }
                            @endphp
                            </span>
                </div>
                @error('Biologie_HbA1C')
                <div class="error">
                    <i class="fas fa-exclamation-circle"></i>
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="Biologie_Non_HDL">
                    <i class="fas fa-heart-broken"></i>
                    Non-HDL Cholesterol
                </label>
                <div class="value-controls">
                    <input type="range" class="value-slider" id="nonHdlSlider" min="1" max="10" step="0.1"
                        value="{{ old('Biologie_Non_HDL', $data['Biologie_Non_HDL'] ?? '3.5') }}">
                    <span class="value-display" id="nonHdlValue">
                        {{ old('Biologie_Non_HDL', $data['Biologie_Non_HDL'] ?? '3.5') }} <small>mmol/L</small>
                    </span>
                </div>
                <div class="range-visual">
                    <div class="range-marker" style="left: 34%;"></div>
                    <div class="range-label" style="left: 34%;">Optimal</div>
                    <div class="range-marker" style="left: 51%;"></div>
                    <div class="range-label" style="left: 51%;">Borderline</div>
                    <div class="range-marker" style="left: 68%;"></div>
                    <div class="range-label" style="left: 68%;">High</div>
                    <div class="current-value-marker" id="nonHdlMarker"
                        style="left: {{ ((old('Biologie_Non_HDL', $data['Biologie_Non_HDL'] ?? 3.5) - 1) / 9 * 100) }}%;"></div>
                </div>
                <input type="hidden" name="Biologie_Non_HDL" id="Biologie_Non_HDL"
                    value="{{ old('Biologie_Non_HDL', $data['Biologie_Non_HDL'] ?? '3.5') }}">
                <br>
                <div class="input-hint">
                    Non-HDL cholesterol is total cholesterol minus HDL.
                    <span id="nonHdlAssessment">
                        @php
                        $nonHdlValue = old('Biologie_Non_HDL', $data['Biologie_Non_HDL'] ?? 3.5);
                        if ($nonHdlValue < 3.4) {
                            echo '<span class="normal-indicator"><i class="fas fa-check-circle"></i> Optimal (<3.4 mmol/L)</span>' ;
                            } elseif ($nonHdlValue < 4.9) {
                            echo '<span class="abnormal-indicator"><i class="fas fa-exclamation-triangle"></i> Borderline (3.4-4.9 mmol/L)</span>' ;
                            } else {
                            echo '<span class="abnormal-indicator"><i class="fas fa-exclamation-triangle"></i> High (≥4.9 mmol/L)</span>' ;
                            }
                            @endphp
                            </span>
                </div>
                @error('Biologie_Non_HDL')
                <div class="error">
                    <i class="fas fa-exclamation-circle"></i>
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="form-group">
                    <label for="Biologie_ClasseMDRD">
                        <i class="fas fa-filter"></i>
                        MDRD Classification
                    </label>
                    <div class="mdr-options">
                        @for ($i = 0; $i <= 6; $i++)
                            <div class="mdr-option">
                            <input type="radio" name="Biologie_ClasseMDRD" id="mdr_{{ $i }}"
                                value="{{ $i }}" class="mdr-input"
                                {{ old('Biologie_ClasseMDRD', $data['Biologie_ClasseMDRD'] ?? '') == $i ? 'checked' : '' }}>
                            <label for="mdr_{{ $i }}" class="mdr-label">
                                Stage {{ $i }}
                            </label>
                    </div>
                    @endfor
                </div>
                <div class="input-hint">
                    MDRD classification stages kidney function from 0 (normal) to 6 (kidney failure).
                </div>
                @error('Biologie_ClasseMDRD')
                <div class="error">
                    <i class="fas fa-exclamation-circle"></i>
                    {{ $message }}
                </div>
                @enderror
            </div>
    </div>

    <div class="form-footer">
        <button type="button" onclick="window.history.back()" class="btn btn-prev">
            <i class="fas fa-arrow-left"></i>
            Previous
        </button>
        <button type="submit" class="btn btn-next">
            Next
            <i class="fas fa-arrow-right"></i>
        </button>
    </div>
    </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // --- ELEMENT SELECTORS ---
            const crpSlider = document.getElementById('crpSlider');
            const crpValue = document.getElementById('crpValue');
            const Biologie_CRP = document.getElementById('Biologie_CRP');
            const crpMarker = document.getElementById('crpMarker');
            const crpAssessment = document.getElementById('crpAssessment');

            const glucoseSlider = document.getElementById('glucoseSlider');
            const glucoseValue = document.getElementById('glucoseValue');
            const Biologie_GAJ = document.getElementById('Biologie_GAJ');
            const glucoseMarker = document.getElementById('glucoseMarker');
            const glucoseAssessment = document.getElementById('glucoseAssessment');

            const hdlSlider = document.getElementById('hdlSlider');
            const hdlValue = document.getElementById('hdlValue');
            const Biologie_HDL_C = document.getElementById('Biologie_HDL-C');
            const hdlMarker = document.getElementById('hdlMarker');
            const hdlAssessment = document.getElementById('hdlAssessment');

            const hba1cSlider = document.getElementById('hba1cSlider');
            const hba1cValue = document.getElementById('hba1cValue');
            const Biologie_HbA1C = document.getElementById('Biologie_HbA1C');
            const hba1cMarker = document.getElementById('hba1cMarker');
            const hba1cAssessment = document.getElementById('hba1cAssessment');

            const nonHdlSlider = document.getElementById('nonHdlSlider');
            const nonHdlValue = document.getElementById('nonHdlValue');
            const Biologie_Non_HDL = document.getElementById('Biologie_Non_HDL');
            const nonHdlMarker = document.getElementById('nonHdlMarker');
            const nonHdlAssessment = document.getElementById('nonHdlAssessment');

            // --- UPDATE FUNCTIONS ---

            function updateCRP(value) {
                const numValue = parseFloat(value);
                crpValue.innerHTML = `${numValue.toFixed(1)} <small>mg/L</small>`;
                Biologie_CRP.value = numValue.toFixed(1);
                crpMarker.style.left = `${(numValue / 50) * 100}%`;

                if (numValue < 10) {
                    crpAssessment.innerHTML = '<span class="normal-indicator"><i class="fas fa-check-circle"></i> Normal (below 10 mg/L)</span>';
                } else {
                    crpAssessment.innerHTML = '<span class="abnormal-indicator"><i class="fas fa-exclamation-triangle"></i> Elevated (≥10 mg/L)</span>';
                }
            }

            function updateGlucose(value) {
                const numValue = parseFloat(value);
                glucoseValue.innerHTML = `${numValue.toFixed(1)} <small>mmol/L</small>`;
                Biologie_GAJ.value = numValue.toFixed(1);
                glucoseMarker.style.left = `${((numValue - 2) / 18) * 100}%`;

                if (numValue < 3.9) {
                    glucoseAssessment.innerHTML = '<span class="abnormal-indicator"><i class="fas fa-exclamation-triangle"></i> Hypoglycemic (<3.9 mmol/L)</span>';
                } else if (numValue < 5.5) {
                    glucoseAssessment.innerHTML = '<span class="normal-indicator"><i class="fas fa-check-circle"></i> Normal (3.9-5.5 mmol/L)</span>';
                } else if (numValue < 7.0) {
                    glucoseAssessment.innerHTML = '<span class="abnormal-indicator"><i class="fas fa-exclamation-triangle"></i> Prediabetes (5.5-7.0 mmol/L)</span>';
                } else {
                    glucoseAssessment.innerHTML = '<span class="abnormal-indicator"><i class="fas fa-exclamation-triangle"></i> Diabetes (≥7.0 mmol/L)</span>';
                }
            }

            function updateHDL(value) {
                const numValue = parseFloat(value);
                hdlValue.innerHTML = `${numValue.toFixed(1)} <small>mmol/L</small>`;
                Biologie_HDL_C.value = numValue.toFixed(1);
                hdlMarker.style.left = `${(numValue / 3) * 100}%`; // <-- FIX: Changed ' to `

                if (numValue >= 1.3) {
                    hdlAssessment.innerHTML = '<span class="normal-indicator"><i class="fas fa-check-circle"></i> Optimal (≥1.3 mmol/L)</span>';
                } else if (numValue >= 1.0) {
                    hdlAssessment.innerHTML = '<span class="normal-indicator"><i class="fas fa-check-circle"></i> Acceptable (≥1.0 mmol/L)</span>';
                } else { // <-- FIX: Completed the else block
                    hdlAssessment.innerHTML = '<span class="abnormal-indicator"><i class="fas fa-exclamation-triangle"></i> Low (<1.0 mmol/L)</span>';
                }
            }

            function updateHbA1c(value) {
                const numValue = parseFloat(value);
                hba1cValue.innerHTML = `${numValue.toFixed(1)} <small>%</small>`;
                Biologie_HbA1C.value = numValue.toFixed(1);
                hba1cMarker.style.left = `${((numValue - 4) / 8) * 100}%`;

                if (numValue < 5.7) {
                    hba1cAssessment.innerHTML = '<span class="normal-indicator"><i class="fas fa-check-circle"></i> Normal (<5.7%)</span>';
                } else if (numValue < 6.5) {
                    hba1cAssessment.innerHTML = '<span class="abnormal-indicator"><i class="fas fa-exclamation-triangle"></i> Prediabetes (5.7-6.4%)</span>';
                } else {
                    hba1cAssessment.innerHTML = '<span class="abnormal-indicator"><i class="fas fa-exclamation-triangle"></i> Diabetes (≥6.5%)</span>';
                }
            }

            function updateNonHdl(value) {
                const numValue = parseFloat(value);
                nonHdlValue.innerHTML = `${numValue.toFixed(1)} <small>mmol/L</small>`;
                Biologie_Non_HDL.value = numValue.toFixed(1);
                nonHdlMarker.style.left = `${((numValue - 1) / 9) * 100}%`;

                if (numValue < 3.4) {
                    nonHdlAssessment.innerHTML = '<span class="normal-indicator"><i class="fas fa-check-circle"></i> Optimal (<3.4 mmol/L)</span>';
                } else if (numValue < 4.9) {
                    nonHdlAssessment.innerHTML = '<span class="abnormal-indicator"><i class="fas fa-exclamation-triangle"></i> Borderline (3.4-4.9 mmol/L)</span>';
                } else {
                    nonHdlAssessment.innerHTML = '<span class="abnormal-indicator"><i class="fas fa-exclamation-triangle"></i> High (≥4.9 mmol/L)</span>';
                }
            }

            // --- EVENT LISTENERS & INITIALIZATION ---
            if (crpSlider) {
                crpSlider.addEventListener('input', (e) => updateCRP(e.target.value));
                updateCRP(crpSlider.value);
            }
            if (glucoseSlider) {
                glucoseSlider.addEventListener('input', (e) => updateGlucose(e.target.value));
                updateGlucose(glucoseSlider.value);
            }
            if (hdlSlider) {
                hdlSlider.addEventListener('input', (e) => updateHDL(e.target.value));
                updateHDL(hdlSlider.value);
            }
            if (hba1cSlider) {
                hba1cSlider.addEventListener('input', (e) => updateHbA1c(e.target.value));
                updateHbA1c(hba1cSlider.value);
            }
            if (nonHdlSlider) {
                nonHdlSlider.addEventListener('input', (e) => updateNonHdl(e.target.value));
                updateNonHdl(nonHdlSlider.value);
            }
        });
        document.addEventListener('DOMContentLoaded', () => {
            // Get current step from the form action URL or default to 1
            const currentStep = parseInt(window.location.pathname.split('/').pop()) || 1;

            // Update bubble navigation
            const bubbles = document.querySelectorAll('.bubble');
            bubbles.forEach(bubble => {
                const bubbleStep = parseInt(bubble.dataset.step);

                if (bubbleStep < currentStep) {
                    bubble.classList.add('completed');
                    bubble.classList.remove('active');
                } else if (bubbleStep === currentStep) {
                    bubble.classList.add('active');
                    bubble.classList.remove('completed');
                } else {
                    bubble.classList.remove('active', 'completed');
                }

                // Make bubbles clickable for navigation
                bubble.addEventListener('click', () => {
                    if (bubbleStep < currentStep) {
                        window.location.href = `/predict/${bubbleStep}`;
                    }
                });
            });
        });
    </script>
</body>

</html>