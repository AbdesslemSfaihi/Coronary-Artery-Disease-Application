<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Step 4 - ECG Results</title>
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
            --ecg-normal: #4ade80;
            --ecg-abnormal: #ef4444;
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
            width: 80%;
            transition: width 0.6s ease;
        }

        /* ECG Specific Styles */
        .ecg-visual {
            width: 100%;
            height: 150px;
            background-color: #f8fafc;
            border-radius: 10px;
            margin: 1rem 0;
            position: relative;
            overflow: hidden;
            border: 2px solid var(--border);
        }

        .ecg-line {
            position: absolute;
            height: 2px;
            width: 100%;
            background-color: #e2e8f0;
            top: 50%;
            transform: translateY(-50%);
        }

        .ecg-waveform {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            stroke: var(--primary);
            stroke-width: 2;
            fill: none;
        }

        .ecg-controls {
            display: flex;
            gap: 1rem;
            margin-top: 1rem;
        }

        .ecg-slider {
            flex-grow: 1;
            -webkit-appearance: none;
            height: 8px;
            border-radius: 4px;
            background: #e2e8f0;
            outline: none;
        }

        .ecg-slider::-webkit-slider-thumb {
            -webkit-appearance: none;
            appearance: none;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: var(--primary);
            cursor: pointer;
            transition: all 0.2s;
        }

        .ecg-slider::-webkit-slider-thumb:hover {
            transform: scale(1.2);
            background: var(--primary-hover);
        }

        .ecg-slider-value {
            min-width: 50px;
            text-align: center;
            font-weight: 600;
            color: var(--primary);
        }

        .toggle-group {
            display: flex;
            gap: 1rem;
            margin-top: 0.5rem;
        }

        .toggle-option {
            flex: 1;
            position: relative;
        }

        .toggle-input {
            position: absolute;
            opacity: 0;
            width: 0;
            height: 0;
        }

        .toggle-label {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0.875rem 1rem;
            border: 2px solid var(--border);
            border-radius: 10px;
            background-color: #fff;
            cursor: pointer;
            transition: all 0.3s;
            font-weight: 500;
            text-align: center;
            gap: 8px;
        }

        .toggle-label i {
            font-size: 1.1rem;
        }

        .toggle-input:checked+.toggle-label {
            border-color: var(--primary);
            background-color: #f5f3ff;
            color: var(--primary);
            font-weight: 600;
        }

        .toggle-input:focus+.toggle-label {
            box-shadow: 0 0 0 4px var(--focus-ring);
        }

        .toggle-option:hover .toggle-label {
            border-color: var(--primary-light);
        }

        .normal-indicator {
            color: var(--ecg-normal);
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .abnormal-indicator {
            color: var(--ecg-abnormal);
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .value-display {
            font-weight: 600;
            color: var(--primary);
            margin-left: 5px;
        }

        @media (max-width: 768px) {
            .form-container {
                padding: 1.75rem;
            }

            .toggle-group {
                flex-direction: column;
            }

            .ecg-controls {
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

        .form-group:nth-child(7) {
            animation-delay: 0.7s;
        }

        .form-group:nth-child(8) {
            animation-delay: 0.8s;
        }

        .form-group:nth-child(9) {
            animation-delay: 0.9s;
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

        .file-upload-container {
            position: relative;
        }

        .file-upload-label {
            display: block;
            cursor: pointer;
        }

        .file-upload-box {
            border: 2px dashed var(--primary-light);
            border-radius: 12px;
            padding: 2rem 1rem;
            text-align: center;
            transition: all 0.3s;
            background-color: rgba(167, 139, 250, 0.05);
        }

        .file-upload-box:hover {
            background-color: rgba(167, 139, 250, 0.1);
            border-color: var(--primary);
        }

        .file-upload-box i {
            font-size: 2.5rem;
            color: var(--primary);
            margin-bottom: 0.75rem;
        }

        .file-upload-text {
            display: block;
            font-weight: 600;
            color: var(--primary);
            margin-bottom: 0.25rem;
        }

        .file-upload-hint {
            font-size: 0.875rem;
            color: #64748b;
        }

        .file-upload-input {
            position: absolute;
            width: 0.1px;
            height: 0.1px;
            opacity: 0;
            overflow: hidden;
            z-index: -1;
        }

        .file-upload-preview {
            margin-top: 1rem;
            display: none;
        }

        .file-upload-preview img {
            max-width: 100%;
            max-height: 200px;
            border-radius: 8px;
            border: 1px solid var(--border);
            display: block;
            margin: 0 auto;
        }

        .btn-primary {
            background: linear-gradient(to right, var(--primary), var(--primary-light));
        }

        .btn-primary:hover {
            background: linear-gradient(to right, var(--primary-hover), var(--primary));
        }
    </style>
</head>

<body>
    <div class="form-container">
        <div class="form-header">
            <div class="form-title">
                <i class="fas fa-heartbeat"></i>
                ECG Results
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


        @php
        $data = session('form_step_4', []);
        @endphp

        <div class="form-section" style="margin-bottom: 2rem;">
            <div class="form-section-title">
                <i class="fas fa-file-upload"></i>
                Upload ECG Image
            </div>

            <form method="POST" action="{{ route('predict.extract.image') }}" enctype="multipart/form-data" class="form-group">
                @csrf

                <div class="file-upload-container">
                    <label for="image" class="file-upload-label">
                        <div class="file-upload-box">
                            <i class="fas fa-cloud-upload-alt"></i>
                            <span class="file-upload-text">Click to browse or drag & drop ECG image</span>
                            <span class="file-upload-hint">Supports JPG, PNG (Max 5MB)</span>
                        </div>
                        <input type="file" name="image" id="image" accept="image/*" required class="file-upload-input">
                    </label>

                    <div class="file-upload-preview" id="filePreview">
                        <!-- Preview will appear here -->
                    </div>

                    <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 1rem;">
                        <i class="fas fa-bolt"></i> Extract ECG Data
                    </button>
                </div>
            </form>

            @if(session('success'))
            <div class="alert alert-success" style="background: var(--success); color: white; padding: 0.75rem 1rem; border-radius: 8px; margin-top: 1rem; display: flex; align-items: center; gap: 8px;">
                <i class="fas fa-check-circle"></i>
                {{ session('success') }}
            </div>
            @endif
        </div>


        <form method="POST" action="{{ route('predict.submit', ['step' => $step]) }}">
            @csrf

            <div class="form-section">
                <div class="form-section-title">
                    <i class="fas fa-wave-square"></i>
                    ECG Waveform Analysis
                </div>

                <div class="form-group">
                    <label for="ECG_End_ST_amplitude">
                        <i class="fas fa-chart-line"></i>
                        End ST Segment Amplitude
                    </label>
                    <div class="ecg-visual">
                        <div class="ecg-line"></div>
                        <svg class="ecg-waveform" viewBox="0 0 500 100" preserveAspectRatio="none">
                            <path id="ecg-st-wave" d="M0,50 L100,50 L110,30 L120,70 L130,50 L200,50 L210,30 L220,70 L230,50 L500,50" />
                        </svg>
                    </div>
                    <div class="ecg-controls">
                        <input type="range" class="ecg-slider" id="stAmplitudeSlider" min="-0.2" max="2" step="0.1"
                            value="{{ old('ECG_End_ST_amplitude', $data['ECG_End_ST_amplitude'] ?? '0') }}">
                        <span class="ecg-slider-value" id="stAmplitudeValue">
                            {{ old('ECG_End_ST_amplitude', $data['ECG_End_ST_amplitude'] ?? '0') }} mm
                        </span>
                    </div>
                    <input type="hidden" name="ECG_End_ST_amplitude" id="ECG_End_ST_amplitude"
                        value="{{ old('ECG_End_ST_amplitude', $data['ECG_End_ST_amplitude'] ?? '0') }}">
                    <div class="input-hint">
                        Normal range: -0.5 to +1.0 mm.
                        <span id="stAssessment">
                            @if(isset($data['ECG_End_ST_amplitude']))
                            @if($data['ECG_End_ST_amplitude'] < -0.5 || $data['ECG_End_ST_amplitude']> 1.0)
                                <span class="abnormal-indicator">
                                    <i class="fas fa-exclamation-triangle"></i> Abnormal
                                </span>
                                @else
                                <span class="normal-indicator">
                                    <i class="fas fa-check-circle"></i> Normal
                                </span>
                                @endif
                                @endif
                        </span>
                    </div>
                    @error('ECG_End_ST_amplitude')
                    <div class="error">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="ECG_PR_interval">
                        <i class="fas fa-ruler-horizontal"></i>
                        PR Interval Duration
                    </label>
                    <div style="position: relative; width: 92%">
                        <i class="fas fa-hourglass-half input-icon"></i>
                        <input type="number" step="1" name="ECG_PR_interval" id="ECG_PR_interval"
                            value="{{ old('ECG_PR_interval', $data['ECG_PR_interval'] ?? '') }}"
                            min="0" placeholder="Enter PR interval in ms">
                        <span class="unit-display">ms</span>
                    </div>
                    <div class="input-hint">
                        Normal range: 120-200 ms.
                        @if(isset($data['ECG_PR_interval']))
                        @if($data['ECG_PR_interval'] < 120 || $data['ECG_PR_interval']> 200)
                            <span class="abnormal-indicator">
                                <i class="fas fa-exclamation-triangle"></i> Abnormal
                            </span>
                            @else
                            <span class="normal-indicator">
                                <i class="fas fa-check-circle"></i> Normal
                            </span>
                            @endif
                            @endif
                    </div>
                    @error('ECG_PR_interval')
                    <div class="error">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="ECG_Mid_ST_amplitude">
                        <i class="fas fa-chart-line"></i>
                        Mid ST Segment Amplitude
                    </label>
                    <div class="ecg-visual">
                        <div class="ecg-line"></div>
                        <svg class="ecg-waveform" viewBox="0 0 500 100" preserveAspectRatio="none">
                            <path id="ecg-midst-wave" d="M0,50 L100,50 L110,30 L120,70 L130,50 L200,50 L210,30 L220,70 L230,50 L500,50" />
                        </svg>
                    </div>
                    <div class="ecg-controls">
                        <input type="range" class="ecg-slider" id="midStAmplitudeSlider" min="-2" max="2" step="0.1"
                            value="{{ old('ECG_Mid_ST_amplitude', $data['ECG_Mid_ST_amplitude'] ?? '0') }}">
                        <span class="ecg-slider-value" id="midStAmplitudeValue">
                            {{ old('ECG_Mid_ST_amplitude', $data['ECG_Mid_ST_amplitude'] ?? '0') }} mm
                        </span>
                    </div>
                    <input type="hidden" name="ECG_Mid_ST_amplitude" id="ECG_Mid_ST_amplitude"
                        value="{{ old('ECG_Mid_ST_amplitude', $data['ECG_Mid_ST_amplitude'] ?? '0') }}">
                    <div class="input-hint">
                        Normal range: -0.5 to +1.0 mm.
                        <span id="midStAssessment">
                            @if(isset($data['ECG_Mid_ST_amplitude']))
                            @if($data['ECG_Mid_ST_amplitude'] < -0.5 || $data['ECG_Mid_ST_amplitude']> 1.0)
                                <span class="abnormal-indicator">
                                    <i class="fas fa-exclamation-triangle"></i> Abnormal
                                </span>
                                @else
                                <span class="normal-indicator">
                                    <i class="fas fa-check-circle"></i> Normal
                                </span>
                                @endif
                                @endif
                        </span>
                    </div>
                    @error('ECG_Mid_ST_amplitude')
                    <div class="error">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>
                        <i class="fas fa-heart-rate"></i>
                        ECG Abnormalities
                    </label>

                    <div class="toggle-group">
                        <div class="toggle-option">
                            <input type="hidden" name="ECG_Poor_R_wave_progression" value="0">
                            <input type="checkbox" name="ECG_Poor_R_wave_progression" id="ECG_Poor_R_wave_progression"
                                value="1" class="toggle-input"
                                {{ old('ECG_Poor_R_wave_progression', $data['ECG_Poor_R_wave_progression'] ?? '') == '1' ? 'checked' : '' }}>
                            <label for="ECG_Poor_R_wave_progression" class="toggle-label">
                                <i class="fas fa-wave-square"></i> Poor R Wave Progression
                            </label>
                        </div>

                        <div class="toggle-option">
                            <input type="hidden" name="ECG_PVC" value="0">
                            <input type="checkbox" name="ECG_PVC" id="ECG_PVC"
                                value="1" class="toggle-input"
                                {{ old('ECG_PVC', $data['ECG_PVC'] ?? '') == '1' ? 'checked' : '' }}>
                            <label for="ECG_PVC" class="toggle-label">
                                <i class="fas fa-heartbeat"></i> PVCs Present
                            </label>
                        </div>
                    </div>

                    <div class="toggle-group" style="margin-top: 0.5rem;">
                        <div class="toggle-option">
                            <input type="hidden" name="ECG_Q_wave" value="0">
                            <input type="checkbox" name="ECG_Q_wave" id="ECG_Q_wave"
                                value="1" class="toggle-input"
                                {{ old('ECG_Q_wave', $data['ECG_Q_wave'] ?? '') == '1' ? 'checked' : '' }}>
                            <label for="ECG_Q_wave" class="toggle-label">
                                <i class="fas fa-search"></i> Pathologic Q Waves
                            </label>
                        </div>

                        <div class="toggle-option">
                            <input type="hidden" name="ECG_QRS_fragmentation" value="0">
                            <input type="checkbox" name="ECG_QRS_fragmentation" id="ECG_QRS_fragmentation"
                                value="1" class="toggle-input"
                                {{ old('ECG_QRS_fragmentation', $data['ECG_QRS_fragmentation'] ?? '') == '1' ? 'checked' : '' }}>
                            <label for="ECG_QRS_fragmentation" class="toggle-label">
                                <i class="fas fa-cut"></i> QRS Fragmentation
                            </label>
                        </div>
                    </div>

                    @error('ECG_Poor_R_wave_progression')
                    <div class="error">
                        <i class="fas fa-exclamation-circle"></i> {{ $message }}
                    </div>
                    @enderror
                    @error('ECG_PVC')
                    <div class="error">
                        <i class="fas fa-exclamation-circle"></i> {{ $message }}
                    </div>
                    @enderror
                    @error('ECG_Q_wave')
                    <div class="error">
                        <i class="fas fa-exclamation-circle"></i> {{ $message }}
                    </div>
                    @enderror
                    @error('ECG_QRS_fragmentation')
                    <div class="error">
                        <i class="fas fa-exclamation-circle"></i> {{ $message }}
                    </div>
                    @enderror
                </div>


                <div class="form-group">
                    <label for="ECG_QRS_duration">
                        <i class="fas fa-ruler-combined"></i>
                        QRS Duration
                    </label>
                    <div style="position: relative; width: 92%;">
                        <i class="fas fa-stopwatch input-icon"></i>
                        <input type="number" step="1" name="ECG_QRS_duration" id="ECG_QRS_duration"
                            value="{{ old('ECG_QRS_duration', $data['ECG_QRS_duration'] ?? '') }}"
                            min="0" placeholder="Enter QRS duration in ms">
                        <span class="unit-display">ms</span>
                    </div>
                    <div class="input-hint">
                        Normal range: 80-120 ms.
                        @if(isset($data['ECG_QRS_duration']))
                        @if($data['ECG_QRS_duration'] < 80 || $data['ECG_QRS_duration']> 120)
                            <span class="abnormal-indicator">
                                <i class="fas fa-exclamation-triangle"></i> Abnormal
                            </span>
                            @else
                            <span class="normal-indicator">
                                <i class="fas fa-check-circle"></i> Normal
                            </span>
                            @endif
                            @endif
                    </div>
                    @error('ECG_QRS_duration')
                    <div class="error">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="ECG_TPE">
                        <i class="fas fa-wave-square"></i>
                        Tpeak-Tend Interval (TPE)
                    </label>
                    <div class="ecg-visual">
                        <div class="ecg-line"></div>
                        <svg class="ecg-waveform" viewBox="0 0 500 100" preserveAspectRatio="none">
                            <path id="ecg-tpe-wave" d="M0,50 L100,50 L110,30 L120,70 L130,50 L200,50 L210,30 L220,70 L230,50 L500,50" />
                        </svg>
                    </div>
                    <div class="ecg-controls">
                        <input type="range" class="ecg-slider" id="tpeSlider" min="40" max="200" step="1"
                            value="{{ old('ECG_TPE', $data['ECG_TPE'] ?? '80') }}">
                        <span class="ecg-slider-value" id="tpeValue">
                            {{ old('ECG_TPE', $data['ECG_TPE'] ?? '80') }} ms
                        </span>
                    </div>
                    <input type="hidden" name="ECG_TPE" id="ECG_TPE"
                        value="{{ old('ECG_TPE', $data['ECG_TPE'] ?? '80') }}">
                    <div class="input-hint">
                        Normal range: 60-100 ms.
                        <span id="tpeAssessment">
                            @if(isset($data['ECG_TPE']))
                            @if($data['ECG_TPE'] < 60 || $data['ECG_TPE']> 100)
                                <span class="abnormal-indicator">
                                    <i class="fas fa-exclamation-triangle"></i> Abnormal
                                </span>
                                @else
                                <span class="normal-indicator">
                                    <i class="fas fa-check-circle"></i> Normal
                                </span>
                                @endif
                                @endif
                        </span>
                    </div>
                    @error('ECG_TPE')
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
                
                <button type="submit" class="btn btn-primary">
    <i class="fas fa-check"></i>
    Submit
</button>
            </div>
        </form>
    </div>

    <script>
        // ECG Slider Controls
        const stAmplitudeSlider = document.getElementById('stAmplitudeSlider');
        const stAmplitudeValue = document.getElementById('stAmplitudeValue');
        const ECG_End_ST_amplitude = document.getElementById('ECG_End_ST_amplitude');
        const ecgStWave = document.getElementById('ecg-st-wave');

        const midStAmplitudeSlider = document.getElementById('midStAmplitudeSlider');
        const midStAmplitudeValue = document.getElementById('midStAmplitudeValue');
        const ECG_Mid_ST_amplitude = document.getElementById('ECG_Mid_ST_amplitude');
        const ecgMidStWave = document.getElementById('ecg-midst-wave');

        const tpeSlider = document.getElementById('tpeSlider');
        const tpeValue = document.getElementById('tpeValue');
        const ECG_TPE = document.getElementById('ECG_TPE');
        const ecgTpeWave = document.getElementById('ecg-tpe-wave');

        // Update ST Segment visualization
        function updateStWave(value) {
            const amplitude = value * 10;
            ecgStWave.setAttribute('d', `M0,50 L100,50 L110,${50-amplitude} L120,${50+amplitude} L130,50 L200,50 L210,${50-amplitude} L220,${50+amplitude} L230,50 L500,50`);

            // Update assessment
            const stAssessment = document.getElementById('stAssessment');
            if (value < -0.5 || value > 1.0) {
                stAssessment.innerHTML = `<span class="abnormal-indicator"><i class="fas fa-exclamation-triangle"></i> Abnormal</span>`;
            } else {
                stAssessment.innerHTML = `<span class="normal-indicator"><i class="fas fa-check-circle"></i> Normal</span>`;
            }
        }

        // Update Mid ST Segment visualization
        function updateMidStWave(value) {
            const amplitude = value * 10;
            ecgMidStWave.setAttribute('d', `M0,50 L100,50 L110,${50-amplitude} L120,${50+amplitude} L130,50 L200,50 L210,${50-amplitude} L220,${50+amplitude} L230,50 L500,50`);

            // Update assessment
            const midStAssessment = document.getElementById('midStAssessment');
            if (value < -0.5 || value > 1.0) {
                midStAssessment.innerHTML = `<span class="abnormal-indicator"><i class="fas fa-exclamation-triangle"></i> Abnormal</span>`;
            } else {
                midStAssessment.innerHTML = `<span class="normal-indicator"><i class="fas fa-check-circle"></i> Normal</span>`;
            }
        }

        // Update TPE visualization
        function updateTpeWave(value) {
            const duration = value / 2;
            ecgTpeWave.setAttribute('d', `M0,50 L100,50 L110,30 L120,70 L130,50 L${200+duration},50 L${210+duration},30 L${220+duration},70 L${230+duration},50 L500,50`);

            // Update assessment
            const tpeAssessment = document.getElementById('tpeAssessment');
            if (value < 60 || value > 100) {
                tpeAssessment.innerHTML = `<span class="abnormal-indicator"><i class="fas fa-exclamation-triangle"></i> Abnormal</span>`;
            } else {
                tpeAssessment.innerHTML = `<span class="normal-indicator"><i class="fas fa-check-circle"></i> Normal</span>`;
            }
        }

        // Initialize ECG visualizations
        updateStWave(parseFloat(stAmplitudeSlider.value));
        updateMidStWave(parseFloat(midStAmplitudeSlider.value));
        updateTpeWave(parseInt(tpeSlider.value));

        // Event listeners for sliders
        stAmplitudeSlider.addEventListener('input', function() {
            const value = parseFloat(this.value);
            stAmplitudeValue.textContent = value.toFixed(1) + ' mm';
            ECG_End_ST_amplitude.value = value;
            updateStWave(value);
        });

        midStAmplitudeSlider.addEventListener('input', function() {
            const value = parseFloat(this.value);
            midStAmplitudeValue.textContent = value.toFixed(1) + ' mm';
            ECG_Mid_ST_amplitude.value = value;
            updateMidStWave(value);
        });

        tpeSlider.addEventListener('input', function() {
            const value = parseInt(this.value);
            tpeValue.textContent = value + ' ms';
            ECG_TPE.value = value;
            updateTpeWave(value);
        });

        // Toggle switches for abnormalities
        document.querySelectorAll('.toggle-input').forEach(toggle => {
            toggle.addEventListener('change', function() {
                const label = this.nextElementSibling;
                if (this.checked) {
                    label.style.transform = 'scale(0.95)';
                    setTimeout(() => {
                        label.style.transform = 'scale(1)';
                    }, 200);
                }
            });
        });

        // Add interactive elements
        document.querySelectorAll('input, select').forEach(element => {
            // Add focus effects
            element.addEventListener('focus', function() {
                const label = this.closest('.form-group').querySelector('label');
                if (label) label.style.color = 'var(--primary)';
            });

            element.addEventListener('blur', function() {
                const label = this.closest('.form-group').querySelector('label');
                if (label) label.style.color = '#334155';
            });

            // Add input validation feedback
            element.addEventListener('input', function() {
                if (this.checkValidity()) {
                    this.style.borderColor = 'var(--success)';
                } else {
                    this.style.borderColor = '';
                }
            });
        });

        // Add floating animation to card on load
        document.addEventListener('DOMContentLoaded', () => {
            const form = document.querySelector('.form-container');
            form.style.opacity = '0';
            form.style.transform = 'translateY(20px)';

            setTimeout(() => {
                form.style.transition = 'all 0.6s ease';
                form.style.opacity = '1';
                form.style.transform = 'translateY(0)';
            }, 100);
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
        document.getElementById('image').addEventListener('change', function(e) {
            const filePreview = document.getElementById('filePreview');
            filePreview.innerHTML = '';

            if (this.files && this.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    const preview = document.createElement('img');
                    preview.src = e.target.result;
                    filePreview.appendChild(preview);
                    filePreview.style.display = 'block';

                    // Add file name display
                    const fileName = document.createElement('div');
                    fileName.textContent = e.target.fileName || 'Selected file: ' + document.getElementById('image').files[0].name;
                    fileName.style.marginTop = '0.5rem';
                    fileName.style.textAlign = 'center';
                    fileName.style.color = '#64748b';
                    fileName.style.fontSize = '0.875rem';
                    filePreview.appendChild(fileName);
                }

                reader.readAsDataURL(this.files[0]);
            }
            // Make bubbles clickable for navigation
                bubble.addEventListener('click', () => {
                    if (bubbleStep < currentStep) {
                        window.location.href = `/predict/${bubbleStep}`;
                    }
                });
        });
    </script>
</body>

</html>