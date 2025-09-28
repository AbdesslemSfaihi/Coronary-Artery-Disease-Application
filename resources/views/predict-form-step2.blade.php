<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Step 2 - Medical History</title>
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
            width: 40%;
            transition: width 0.6s ease;
        }

        .duration-input {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .duration-input input {
            width: 300px;
            padding: 0.875rem 1rem;
            text-align: center;
        }

        .duration-unit {
            color: #64748b;
            font-weight: 500;
        }


        /* Desktop layout for horizontal fields */
        .horizontal-fields {
            display: flex;
            flex-direction: row;
            gap: 2rem;
            flex-wrap: wrap;
            align-items: flex-start;
        }

        .horizontal-fields .form-group {
            flex: 1;
            min-width: 200px;
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

        .form-group:nth-child(5) {
            animation-delay: 0.5s;
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
                <i class="fas fa-heartbeat"></i> Medical History
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

            <!-- HTA Section -->
            <div class="form-section">
                <div class="form-section-title">
                    <i class="fas fa-heart"></i> Hypertension (HTA)
                </div>

                <div class="form-group">
                    <label><i class="fas fa-stethoscope"></i> Do you have hypertension?</label>
                    <div class="radio-group">
                        <div class="radio-option">
                            <input type="radio" name="Antécédants_médicaux_HTA" id="hta_yes" value="1"
                                {{ old('Antécédants_médicaux_HTA', $data['Antécédants_médicaux_HTA'] ?? '') == '1' ? 'checked' : '' }} />
                            <label for="hta_yes" class="radio-label">
                                <i class="fas fa-check-circle" style="color: var(--success)"></i> Yes
                            </label>
                        </div>
                        <div class="radio-option">
                            <input type="radio" name="Antécédants_médicaux_HTA" id="hta_no" value="0"
                                {{ old('Antécédants_médicaux_HTA', $data['Antécédants_médicaux_HTA'] ?? '') == '0' ? 'checked' : '' }} />
                            <label for="hta_no" class="radio-label">
                                <i class="fas fa-times-circle" style="color: var(--error)"></i> No
                            </label>
                        </div>
                    </div>
                    @error('Antécédants_médicaux_HTA')
                    <div class="error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                </div>






                <div class="form-group" id="hta_duration_group" style="display: none;">
                    <label><i class="fas fa-clock"></i> Years with Hypertension</label>
                    <div style="position: relative;">
                        <i class="fas fa-calendar input-icon"></i>
                        <div class="duration-input">
                            <input type="number" name="Antécédants_médicaux_HTA_ancienneté" id="Antécédants_médicaux_HTA_ancienneté"
                                value="{{ old('Antécédants_médicaux_HTA_ancienneté', $data['Antécédants_médicaux_HTA_ancienneté'] ?? '') }}"
                                min="0" max="100" placeholder="0" />
                            <span class="duration-unit">years</span>
                        </div>
                    </div>
                    @error('Antécédants_médicaux_HTA_ancienneté')
                    <div class="error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                </div>
            </div>


            <div class="form-group">
                <label>
                    <i class="fas fa-heartbeat"></i>
                    Electrical HVG (Left Ventricular Hypertrophy)
                </label>
                <div class="radio-group">
                    <div class="radio-option">
                        <input type="radio" name="Antécédants_médicaux_HTA_HVG_électrique" id="hvg_yes" value="1"
                            {{ old('Antécédants_médicaux_HTA_HVG_électrique', $data['Antécédants_médicaux_HTA_HVG_électrique'] ?? '') == '1' ? 'checked' : '' }} />
                        <label for="hvg_yes" class="radio-label">
                            <i class="fas fa-check-circle" style="color: var(--success);"></i> Yes
                        </label>
                    </div>
                    <div class="radio-option">
                        <input type="radio" name="Antécédants_médicaux_HTA_HVG_électrique" id="hvg_no" value="0"
                            {{ old('Antécédants_médicaux_HTA_HVG_électrique', $data['Antécédants_médicaux_HTA_HVG_électrique'] ?? '') == '0' ? 'checked' : '' }} />
                        <label for="hvg_no" class="radio-label">
                            <i class="fas fa-times-circle" style="color: var(--error);"></i> No
                        </label>
                    </div>
                </div>
                @error('Antécédants_médicaux_HTA_HVG_électrique')
                <div class="error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                @enderror
            </div>



            <!-- Diabetes & Renal Combined in One Row -->
            <div class="form-section horizontal-fields">
                <div class="form-group">
                    <label><i class="fas fa-clock"></i> Years with Diabetes</label>
                    <div style="position: relative;">
                        <i class="fas fa-calendar input-icon"></i>
                        <div class="duration-input">
                            <input type="number" name="Antécédants_médicaux_Diabète_ancienneté"
                                id="Antécédants_médicaux_Diabète_ancienneté"
                                value="{{ old('Antécédants_médicaux_Diabète_ancienneté', $data['Antécédants_médicaux_Diabète_ancienneté'] ?? 0) }}"
                                min="0" max="100" placeholder="0" />
                            <span class="duration-unit">years</span>
                        </div>
                    </div>
                    @error('Antécédants_médicaux_Diabète_ancienneté')
                    <div class="error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label><i class="fas fa-clock"></i> Years with Renal Insufficiency</label>
                    <div style="position: relative;">
                        <i class="fas fa-calendar input-icon"></i>
                        <div class="duration-input">
                            <input type="number" name="Antécédants_médicaux_insuffisance_rénale_ancienneté"
                                id="Antécédants_médicaux_insuffisance_rénale_ancienneté"
                                value="{{ old('Antécédants_médicaux_insuffisance_rénale_ancienneté', $data['Antécédants_médicaux_insuffisance_rénale_ancienneté'] ?? 0) }}"
                                min="0" max="50" placeholder="0" />
                            <span class="duration-unit">years</span>
                        </div>
                    </div>
                    @error('Antécédants_médicaux_insuffisance_rénale_ancienneté')
                    <div class="error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Footer -->
            <div class="form-footer">
                <button type="button" onclick="window.history.back()" class="btn btn-prev">
                    <i class="fas fa-arrow-left"></i> Previous
                </button>
                <button type="submit" class="btn btn-next">
                    Next <i class="fas fa-arrow-right"></i>
                </button>
            </div>
        </form>
    </div>

    <!-- JS logic -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const htaYes = document.getElementById('hta_yes');
            const htaNo = document.getElementById('hta_no');
            const htaDurationGroup = document.getElementById('hta_duration_group');
            const htaInput = document.getElementById('Antécédants_médicaux_HTA_ancienneté');

            function toggleHTADuration() {
                if (htaYes.checked) {
                    htaDurationGroup.style.display = 'block';
                } else {
                    htaDurationGroup.style.display = 'none';
                    htaInput.value = 0;
                }
            }

            toggleHTADuration();
            htaYes.addEventListener('change', toggleHTADuration);
            htaNo.addEventListener('change', toggleHTADuration);
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