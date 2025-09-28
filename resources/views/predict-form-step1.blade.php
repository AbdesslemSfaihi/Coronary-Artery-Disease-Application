<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Step 1 - General Information</title>
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
            --normal-weight: #4ade80;
            --overweight: #fbbf24;
            --obese1: #f97316;
            --obese2: #ef4444;
            --obese3: #b91c1c;
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

        .radio-group {
            display: flex;
            gap: 1rem;
            margin-top: 0.5rem;
        }

        .radio-option {
            flex: 1;
            position: relative;
        }

        .radio-option input {
            position: absolute;
            opacity: 0;
            width: 0;
            height: 0;
        }

        .radio-label {
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

        .radio-label i {
            font-size: 1.1rem;
        }

        .radio-option input:checked+.radio-label {
            border-color: var(--primary);
            background-color: #f5f3ff;
            color: var(--primary);
            font-weight: 600;
        }

        .radio-option input:focus+.radio-label {
            box-shadow: 0 0 0 4px var(--focus-ring);
        }

        .radio-option:hover .radio-label {
            border-color: var(--primary-light);
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
            justify-content: flex-end;
            margin-top: 3rem;
        }

        .btn {
            background: linear-gradient(to right, var(--primary), var(--primary-light));
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
            box-shadow: 0 4px 6px -1px rgba(124, 58, 237, 0.3), 0 2px 4px -1px rgba(124, 58, 237, 0.1);
        }

        .btn:hover {
            background: linear-gradient(to right, var(--primary-hover), var(--primary));
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(124, 58, 237, 0.3), 0 4px 6px -2px rgba(124, 58, 237, 0.1);
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
            width: 20%;
            transition: width 0.6s ease;
        }

        /* IMC Category Styles */
        .imc-option {
            border-left: 4px solid;
            padding-left: 1rem;
            margin-bottom: 0.75rem;
            transition: all 0.3s;
        }

        .imc-option:hover {
            transform: translateX(5px);
        }

        .imc-option input {
            position: absolute;
            opacity: 0;
        }

        .imc-label {
            display: flex;
            align-items: center;
            padding: 0.875rem 1rem;
            border: 2px solid var(--border);
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s;
            position: relative;
        }

        .imc-label::before {
            content: '';
            width: 18px;
            height: 18px;
            border: 2px solid var(--border);
            border-radius: 50%;
            margin-right: 1rem;
            transition: all 0.3s;
        }

        .imc-option input:checked+.imc-label {
            border-color: var(--primary);
            background-color: #f5f3ff;
        }

        .imc-option input:checked+.imc-label::before {
            border-color: var(--primary);
            background-color: var(--primary);
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='white'%3E%3Cpath d='M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z'/%3E%3C/svg%3E");
            background-size: 12px;
            background-repeat: no-repeat;
            background-position: center;
        }

        .imc-category {
            font-weight: 600;
            flex-grow: 1;
        }

        .imc-range {
            color: #64748b;
            font-size: 0.875rem;
        }

        .normal {
            border-color: var(--normal-weight);
        }

        .overweight {
            border-color: var(--overweight);
        }

        .obese1 {
            border-color: var(--obese1);
        }

        .obese2 {
            border-color: var(--obese2);
        }

        .obese3 {
            border-color: var(--obese3);
        }

        @media (max-width: 768px) {
            .form-container {
                padding: 1.75rem;
            }

            .radio-group {
                flex-direction: column;
                gap: 0.75rem;
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

        /* Remove the JavaScript click handler since we're using links now */
    </style>
</head>

<body>
    <div class="form-container">
        <div class="form-header">
            <div class="form-title">
                <i class="fas fa-user-circle"></i>
                Patient General Information
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

            <div id="step-warning" style="color: red; margin-top: 10px; text-align: center; display: none;">
                <!-- Message will be injected here -->
            </div>



            <form method="POST" action="{{ route('predict.submit', ['step' => $step]) }}">
                @csrf

                <div class="form-group">
                    <label for="Age">
                        <i class="fas fa-birthday-cake"></i>
                        Age
                    </label>
                    <div style="position: relative;">
                        <i class="fas fa-user input-icon"></i>
                        <input type="number" name="Age" id="Age" value="{{ old('Age', $data['Age'] ?? '') }}"
                            min="18" max="120" placeholder="Enter your age" style="width: 770px;">
                    </div>
                    @error('Age')
                    <div class="error">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>
                        <i class="fas fa-venus-mars"></i>
                        Gender
                    </label>
                    <div class="radio-group">
                        <div class="radio-option">
                            <input type="radio" name="Sexe" id="Sexe_male" value="1"
                                {{ old('Sexe', $data['Sexe'] ?? '') == '1' ? 'checked' : '' }}>
                            <label for="Sexe_male" class="radio-label">
                                <i class="fas fa-male"></i>
                                Male
                            </label>
                        </div>
                        <div class="radio-option">
                            <input type="radio" name="Sexe" id="Sexe_female" value="0"
                                {{ old('Sexe', $data['Sexe'] ?? '') == '0' ? 'checked' : '' }}>
                            <label for="Sexe_female" class="radio-label">
                                <i class="fas fa-female"></i>
                                Female
                            </label>
                        </div>
                    </div>
                    @error('Sexe')
                    <div class="error">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>
                        <i class="fas fa-lungs"></i>
                        COPD
                    </label>
                    <div class="radio-group">
                        <div class="radio-option">
                            <input type="radio" name="Antécédants_médicaux_BPCO" id="BPCO_yes" value="1"
                                {{ old('Antécédants_médicaux_BPCO', $data['Antécédants_médicaux_BPCO'] ?? '') == '1' ? 'checked' : '' }}>
                            <label for="BPCO_yes" class="radio-label">
                                <i class="fas fa-check-circle" style="color: var(--success);"></i>
                                Yes
                            </label>
                        </div>
                        <div class="radio-option">
                            <input type="radio" name="Antécédants_médicaux_BPCO" id="BPCO_no" value="0"
                                {{ old('Antécédants_médicaux_BPCO', $data['Antécédants_médicaux_BPCO'] ?? '') == '0' ? 'checked' : '' }}>
                            <label for="BPCO_no" class="radio-label">
                                <i class="fas fa-times-circle" style="color: var(--error);"></i>
                                No
                            </label>
                        </div>
                    </div>
                    <div class="input-hint">
                        Chronic Obstructive Pulmonary Disease - A chronic inflammatory lung disease that causes obstructed airflow from the lungs
                    </div>
                    @error('Antécédants_médicaux_BPCO')
                    <div class="error">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>
                        <i class="fas fa-weight-scale"></i>
                        BMI Category
                    </label>

                    <div class="imc-option normal">
                        <input type="radio" name="Antécédants_médicaux_IMC_classe" id="imc_normal" value="0"
                            {{ old('Antécédants_médicaux_IMC_classe', $data['Antécédants_médicaux_IMC_classe'] ?? '') == '0' ? 'checked' : '' }}>
                        <label for="imc_normal" class="imc-label">
                            <span class="imc-category">Normal Weight</span>
                            <span class="imc-range">(BMI 18.5-24.9)</span>
                        </label>
                    </div>

                    <div class="imc-option overweight">
                        <input type="radio" name="Antécédants_médicaux_IMC_classe" id="imc_overweight" value="1"
                            {{ old('Antécédants_médicaux_IMC_classe', $data['Antécédants_médicaux_IMC_classe'] ?? '') == '1' ? 'checked' : '' }}>
                        <label for="imc_overweight" class="imc-label">
                            <span class="imc-category">Overweight</span>
                            <span class="imc-range">(BMI 25-29.9)</span>
                        </label>
                    </div>

                    <div class="imc-option obese1">
                        <input type="radio" name="Antécédants_médicaux_IMC_classe" id="imc_obese1" value="2"
                            {{ old('Antécédants_médicaux_IMC_classe', $data['Antécédants_médicaux_IMC_classe'] ?? '') == '2' ? 'checked' : '' }}>
                        <label for="imc_obese1" class="imc-label">
                            <span class="imc-category">Moderate Obesity</span>
                            <span class="imc-range">(BMI 30-34.9)</span>
                        </label>
                    </div>

                    <div class="imc-option obese2">
                        <input type="radio" name="Antécédants_médicaux_IMC_classe" id="imc_obese2" value="3"
                            {{ old('Antécédants_médicaux_IMC_classe', $data['Antécédants_médicaux_IMC_classe'] ?? '') == '3' ? 'checked' : '' }}>
                        <label for="imc_obese2" class="imc-label">
                            <span class="imc-category">Severe Obesity</span>
                            <span class="imc-range">(BMI 35-39.9)</span>
                        </label>
                    </div>

                    <div class="imc-option obese3">
                        <input type="radio" name="Antécédants_médicaux_IMC_classe" id="imc_obese3" value="4"
                            {{ old('Antécédants_médicaux_IMC_classe', $data['Antécédants_médicaux_IMC_classe'] ?? '') == '4' ? 'checked' : '' }}>
                        <label for="imc_obese3" class="imc-label">
                            <span class="imc-category">Morbid Obesity</span>
                            <span class="imc-range">(BMI ≥40)</span>
                        </label>
                    </div>

                    @error('Antécédants_médicaux_IMC_classe')
                    <div class="error">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="form-footer">
                    <button type="submit" class="btn">
                        Next
                        <i class="fas fa-arrow-right"></i>
                    </button>
                </div>
            </form>
        </div>
        <div id="completed-steps" data-steps="{{ implode(',', $completedSteps ?? []) }}"></div>

        <script>
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

            // Animate radio buttons on click
            document.querySelectorAll('.radio-option input, .imc-option input').forEach(radio => {
                radio.addEventListener('click', function() {
                    const label = this.nextElementSibling;
                    label.style.transform = 'scale(0.95)';
                    setTimeout(() => {
                        label.style.transform = 'scale(1)';
                    }, 200);
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
        </script>
</body>

</html>