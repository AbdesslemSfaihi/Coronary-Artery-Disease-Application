<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>CAD Prediction Result</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --very-high: #d32f2f;
            --high: #f57c00;
            --moderate: #ffb300;
            --low: #7cb342;
            --very-low: #388e3c;
            --primary-color: #4361ee;
            --secondary-color: #3a0ca3;
            --light-bg: #f8f9fa;
            --dark-text: #212529;
            --gray-text: #6c757d;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #e4e8f0 100%);
            margin: 0;
            padding: 20px;
            color: var(--dark-text);
            min-height: 100vh;
        }

        .container {
            max-width: 900px;
            margin: 40px auto;
            background: #fff;
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            position: relative;
            overflow: hidden;
            animation: fadeInUp 0.6s ease-out;
        }

        .container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 8px;
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes pulseRisk {
            0% {
                box-shadow: 0 0 0 0 rgba(211, 47, 47, 0.4);
            }

            70% {
                box-shadow: 0 0 0 12px rgba(211, 47, 47, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(211, 47, 47, 0);
            }
        }

        @keyframes pulseHigh {
            0% {
                box-shadow: 0 0 0 0 rgba(245, 124, 0, 0.4);
            }

            70% {
                box-shadow: 0 0 0 12px rgba(245, 124, 0, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(245, 124, 0, 0);
            }
        }

        h1 {
            text-align: center;
            color: var(--primary-color);
            margin-bottom: 30px;
            font-size: 2.2rem;
            position: relative;
            padding-bottom: 15px;
        }

        h1::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
            border-radius: 2px;
        }

        /* Risk Result Box */
        .result-box {
            margin: 40px 0;
            padding: 25px;
            border-radius: 12px;
            font-size: 1.1rem;
            display: flex;
            align-items: center;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            animation: pulse 2s infinite;
            border-left: 6px solid;
        }

        .result-box.very-high {
            background-color: #ffebee;
            border-left-color: var(--very-high);
            animation: pulseRisk 2s infinite;
        }

        .result-box.high {
            background-color: #fff3e0;
            border-left-color: var(--high);
            animation: pulseHigh 2s infinite;
        }

        .result-box.moderate {
            background-color: #fff8e1;
            border-left-color: var(--moderate);
        }

        .result-box.low {
            background-color: #f1f8e9;
            border-left-color: var(--low);
        }

        .result-box.very-low {
            background-color: #e8f5e9;
            border-left-color: var(--very-low);
        }

        .result-icon {
            font-size: 2.5rem;
            margin-right: 20px;
            flex-shrink: 0;
        }

        .very-high .result-icon {
            color: var(--very-high);
        }

        .high .result-icon {
            color: var(--high);
        }

        .moderate .result-icon {
            color: var(--moderate);
        }

        .low .result-icon {
            color: var(--low);
        }

        .very-low .result-icon {
            color: var(--very-low);
        }

        /* Probability Meter */
        .probability-meter {
            margin-top: 15px;
            height: 20px;
            background-color: #e9ecef;
            border-radius: 10px;
            overflow: hidden;
            position: relative;
        }

        .probability-fill {
            height: 100%;
            border-radius: 10px;
            transition: width 1.5s ease-out;
            width: 0%;
            position: relative;
        }

        .probability-fill::after {
            content: '';
            position: absolute;
            right: 0;
            top: 0;
            bottom: 0;
            width: 10px;
            background: rgba(255, 255, 255, 0.5);
            border-radius: 0 10px 10px 0;
        }

        .probability-labels {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
            font-size: 0.85rem;
            color: var(--gray-text);
            position: relative;
        }

        .probability-labels::before {
            content: '';
            position: absolute;
            top: -25px;
            left: 0;
            right: 0;
            height: 20px;
            background: linear-gradient(90deg,
                    var(--very-low) 0%,
                    var(--very-low) 5%,
                    var(--low) 5%,
                    var(--low) 15%,
                    var(--moderate) 15%,
                    var(--moderate) 50%,
                    var(--high) 50%,
                    var(--high) 85%,
                    var(--very-high) 85%,
                    var(--very-high) 100%);
            border-radius: 5px;
        }

        .probability-marker {
            position: absolute;
            top: -40px;
            left: 0%;
            transform: translateX(-50%);
            color: white;
            background: var(--primary-color);
            padding: 3px 8px;
            border-radius: 15px;
            font-size: 0.8rem;
            font-weight: bold;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            transition: left 1.5s ease-out;
        }

        .probability-marker::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 50%;
            transform: translateX(-50%);
            width: 0;
            height: 0;
            border-left: 6px solid transparent;
            border-right: 6px solid transparent;
            border-top: 8px solid var(--primary-color);
        }

        /* Info Sections */
        .info-section {
            margin: 30px 0;
            background: var(--light-bg);
            padding: 20px;
            border-radius: 10px;
            border-left: 4px solid var(--primary-color);
        }

        .info-section h3 {
            margin-top: 0;
            color: var(--primary-color);
            display: flex;
            align-items: center;
        }

        .info-section h3 i {
            margin-right: 10px;
        }

        /* Recommendations Grid */
        .recommendation-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .recommendation-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            border-top: 4px solid;
            position: relative;
            overflow: hidden;
            cursor: pointer;
        }

        .recommendation-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
        }

        .recommendation-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.1) 0%, rgba(255, 255, 255, 0) 100%);
            z-index: 1;
        }

        .recommendation-card.urgent {
            border-top-color: #d32f2f;
        }

        .recommendation-card.important {
            border-top-color: #f57c00;
        }

        .recommendation-card.standard {
            border-top-color: #ffb300;
        }

        .recommendation-card.info {
            border-top-color: #7cb342;
        }

        .recommendation-card img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 15px;
            transition: transform 0.3s ease;
        }

        .recommendation-card:hover img {
            transform: scale(1.05);
        }

        .recommendation-card i {
            font-size: 1.8rem;
            margin-bottom: 15px;
            display: block;
        }

        .recommendation-card.urgent i {
            color: #d32f2f;
        }

        .recommendation-card.important i {
            color: #f57c00;
        }

        .recommendation-card.standard i {
            color: #ffb300;
        }

        .recommendation-card.info i {
            color: #7cb342;
        }

        .recommendation-card h4 {
            margin-top: 0;
            margin-bottom: 10px;
            color: var(--dark-text);
        }

        .recommendation-card p {
            margin: 0;
            color: var(--gray-text);
            font-size: 0.95rem;
        }

        .recommendation-card .card-footer {
            margin-top: 15px;
            padding-top: 10px;
            border-top: 1px dashed #eee;
            font-size: 0.8rem;
            color: var(--gray-text);
            display: flex;
            align-items: center;
        }

        .recommendation-card .card-footer i {
            font-size: 0.8rem;
            margin-right: 5px;
            margin-bottom: 0;
        }

        /* Testing Approach */
        .testing-approach {
            margin: 30px 0;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border: 1px solid #e0e0e0;
        }

        .testing-approach h3 {
            margin-top: 0;
            color: var(--primary-color);
            border-bottom: 2px solid #eee;
            padding-bottom: 10px;
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            overflow: auto;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border-radius: 10px;
            max-width: 700px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            position: relative;
        }

        .close {
            position: absolute;
            top: 15px;
            right: 25px;
            font-size: 28px;
            font-weight: bold;
            color: #aaa;
            cursor: pointer;
        }

        .close:hover {
            color: #333;
        }

        .modal-image {
            width: 100%;
            border-radius: 5px;
            margin-top: 15px;
        }

        /* Buttons */
        .button {
            display: inline-flex;
            align-items: center;
            padding: 12px 25px;
            background-color: var(--primary-color);
            color: white;
            text-decoration: none;
            border-radius: 30px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 8px rgba(67, 97, 238, 0.3);
            border: none;
            cursor: pointer;
        }

        .button:hover {
            background-color: var(--secondary-color);
            transform: translateY(-3px);
            box-shadow: 0 6px 12px rgba(67, 97, 238, 0.4);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .container {
                padding: 25px;
            }

            .result-box {
                flex-direction: column;
                text-align: center;
            }

            .result-icon {
                margin-right: 0;
                margin-bottom: 15px;
            }

            .recommendation-grid {
                grid-template-columns: 1fr;
            }
        }



        .action-buttons {
            margin-top: 10px;
            display: flex;
            justify-content: center;
            gap: 15px;
        }

        .approve-btn,
        .decline-btn {
            padding: 8px 16px;
            border: none;
            border-radius: 6px;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .approve-btn {
            background-color: #2e7d32;
            color: white;
        }

        .approve-btn:hover {
            background-color: #1b5e20;
        }

        .decline-btn {
            background-color: #c62828;
            color: white;
        }

        .decline-btn:hover {
            background-color: #8e0000;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Coronary Artery Disease Prediction Result</h1>

        @php
        // Determine risk category based on probability
        $probability = $result['probabilities'][1];
        $percent = round($probability * 100);

        if ($percent > 85) {
        $riskCategory = 'very-high';
        $label = 'Very High (>85%)';
        $icon = 'fa-heart-crack';
        $recommendation = 'Invasive coronary angiography is recommended as first-line test';
        $testOptions = ['angio'];
        } elseif ($percent > 50) {
        $riskCategory = 'high';
        $label = 'High (>50–85%)';
        $icon = 'fa-heart-pulse';
        $recommendation = 'Functional imaging is recommended as first-line test';
        $testOptions = ['nuclear', 'cmr', 'stress']; // Combined SPECT/PET into 'nuclear'
        } elseif ($percent > 15) {
        $riskCategory = 'moderate';
        $label = 'Moderate (>15–50%)';
        $icon = 'fa-heart-circle-exclamation';
        $recommendation = 'CCTA or Functional imaging recommended';
        $testOptions = ['ccta', 'nuclear', 'cmr', 'stress'];
        } elseif ($percent > 5) {
        $riskCategory = 'low';
        $label = 'Low (>5–15%)';
        $icon = 'fa-heart-circle-check';
        $recommendation = 'Adjust clinical likelihood or perform CCTA';
        $testOptions = ['ccta'];
        } else {
        $riskCategory = 'very-low';
        $label = 'Very Low (≤5%)';
        $icon = 'fa-heart-circle-bolt';
        $recommendation = 'Defer further testing';
        $testOptions = [];
        }

        logger('CAD probability: ' . $probability . ' -> ' . $percent . '%');
        @endphp

        <!-- Risk Result Display -->
        <div class="result-box {{ $riskCategory }}">
            <div class="result-icon">
                <i class="fas {{ $icon }}"></i>
            </div>
            <div class="result-content">
                <strong>Risk Category: {{ $label }}</strong><br>
                Based on the analysis, this patient shows a <strong>{{ $percent }}% probability</strong>
                of having Coronary Artery Disease (CAD).
                @if($riskCategory == 'very-high' || $riskCategory == 'high')
                <span style="font-weight:bold;">Immediate clinical evaluation is recommended.</span>
                @endif
            </div>
        </div>

        <!-- Probability Visualization -->
        <div class="probability-meter">
            <div class="probability-fill {{ $riskCategory }}" style="width: 0%"></div>
            <div class="probability-marker" style="left: 0%">{{ $percent }}%</div>
        </div>
        <div class="probability-labels">
            <span>0%</span>
            <span>50%</span>
            <span>100%</span>
        </div>

        <!-- Clinical Interpretation -->
        <div class="info-section">
            <h3><i class="fas fa-stethoscope"></i> Clinical Interpretation</h3>
            <p><strong>Risk Category:</strong> <span class="{{ $riskCategory }}" style="font-weight:bold;">{{ $label }}</span></p>
            <p><strong>Suggested Action:</strong> {{ $recommendation }}</p>
            <p><strong>Clinical Likelihood:</strong> Risk factor-weighted clinical likelihood of obstructive CAD</p>
        </div>

        <!-- Testing Approach (Hidden by default) -->
        <div class="testing-approach" id="testingApproach" style="display:none;">
            <h3><i class="fas fa-clipboard-list"></i> Appropriate First-line Test for Suspected CCS</h3>
            <p>Based on the risk factor-weighted clinical likelihood of obstructive CAD:</p>

            <div class="approach-grid">
                <div class="approach-card very-high">
                    <h4><i class="fas fa-heart-crack"></i> Very High (>85%)</h4>
                    <p>First-line test recommendation:</p>
                    <ul class="test-options">
                        <li><i class="fas fa-arrow-right"></i> Invasive coronary angiography</li>
                    </ul>
                </div>

                <div class="approach-card high">
                    <h4><i class="fas fa-heart-pulse"></i> High (>50–85%)</h4>
                    <p>First-line test options:</p>
                    <ul class="test-options">
                        <li><i class="fas fa-arrow-right"></i> Functional imaging</li>
                        <li><i class="fas fa-arrow-right"></i> PET/SPECT</li>
                        <li><i class="fas fa-arrow-right"></i> CMR</li>
                        <li><i class="fas fa-arrow-right"></i> Stress Echo</li>
                    </ul>
                </div>

                <div class="approach-card moderate">
                    <h4><i class="fas fa-heart-circle-exclamation"></i> Moderate (>15–50%)</h4>
                    <p>First-line test options:</p>
                    <ul class="test-options">
                        <li><i class="fas fa-arrow-right"></i> CCTA</li>
                        <li><i class="fas fa-arrow-right"></i> OR Functional imaging</li>
                    </ul>
                </div>

                <div class="approach-card low">
                    <h4><i class="fas fa-heart-circle-check"></i> Low (>5–15%)</h4>
                    <p>First-line test options:</p>
                    <ul class="test-options">
                        <li><i class="fas fa-arrow-right"></i> Adjust clinical likelihood</li>
                        <li><i class="fas fa-arrow-right"></i> CCTA</li>
                    </ul>
                </div>

                <div class="approach-card very-low">
                    <h4><i class="fas fa-heart-circle-bolt"></i> Very Low (≤5%)</h4>
                    <p>Recommendation:</p>
                    <ul class="test-options">
                        <li><i class="fas fa-arrow-right"></i> Defer further testing</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Recommendations Section -->
        @if(!empty($testOptions))
        <div class="info-section">
            <h3><i class="fas fa-clipboard-list"></i> Recommended Diagnostic Tests</h3>

            <div class="recommendation-grid">
                @foreach($testOptions as $test)
                @if($test == 'angio')
                <div class="recommendation-card urgent" onclick="openModal('angio')">
                    <img src="/images/angi.jpg" alt="Angiography">
                    <i class="fas fa-procedures"></i>
                    <h4>Invasive Coronary Angiography</h4>
                    <p>Gold standard for diagnosing CAD. Provides detailed images of coronary arteries.</p>
                    <div class="card-footer">
                        <i class="fas fa-clock"></i> Action required: Immediately
                    </div>

                    @if($riskCategory == 'very-high')
                    <div class="action-buttons">
                        <button class="approve-btn" onclick="event.stopPropagation(); handleDecision('approve')">Approve</button>
                        <button class="decline-btn" onclick="event.stopPropagation(); handleDecision('decline')">Decline</button>
                    </div>
                    @endif
                </div>

                @elseif($test == 'ccta')
                <div class="recommendation-card important" onclick="openModal('ccta')">
                    <img src="/images/ccta.jpg" alt="CCTA">
                    <i class="fas fa-lungs"></i>
                    <h4>Coronary CT Angiography</h4>
                    <p>Non-invasive test that uses CT imaging to visualize coronary arteries.</p>
                    <div class="card-footer">
                        <i class="fas fa-calendar"></i> Recommended within 1 week
                    </div>
                </div>
                @elseif($test == 'cmr')
                <div class="recommendation-card standard" onclick="openModal('cmr')">
                    <img src="/images/cmr.png" alt="CMR">
                    <i class="fas fa-magnet"></i>
                    <h4>Cardiac MRI</h4>
                    <p>Provides detailed images of heart structure and function without radiation.</p>
                    <div class="card-footer">
                        <i class="fas fa-calendar"></i> Consider within 2 weeks
                    </div>
                </div>
                @elseif($test == 'nuclear')
                <div class="recommendation-card standard" onclick="openModal('nuclear')">
                    <img src="/images/SpectAndPet.png" alt="SPECT/PET">
                    <i class="fas fa-radiation"></i>
                    <h4>Nuclear Imaging (SPECT/PET)</h4>
                    <p>Assesses myocardial perfusion and viability using radioactive tracers.</p>
                    <div class="card-footer">
                        <i class="fas fa-calendar"></i> Consider within 2 weeks
                    </div>
                </div>
                @elseif($test == 'stress')
                <div class="recommendation-card info" onclick="openModal('stress')">
                    <img src="/images/stress.png" alt="Stress Test">
                    <i class="fas fa-heartbeat"></i>
                    <h4>Stress Testing</h4>
                    <p>Evaluates heart function during physical exertion or pharmacologic stress.</p>
                    <div class="card-footer">
                        <i class="fas fa-calendar"></i> Consider within 2-4 weeks
                    </div>
                </div>
                @endif
                @endforeach
            </div>
        </div>
        @endif

        <!-- Additional Recommendations -->
        <div class="info-section">
            <h3><i class="fas fa-procedures"></i> Additional Recommendations</h3>
            <div class="recommendation-grid">
                <div class="recommendation-card urgent">
                    <img src="/images/medication.jpg" alt="Medication">
                    <i class="fas fa-prescription-bottle-medical"></i>
                    <h4>Medical Therapy</h4>
                    <p>Optimize medications including antiplatelets, statins, and anti-anginal therapy.</p>
                    <div class="card-footer">
                        <i class="fas fa-clock"></i> Ongoing management
                    </div>
                </div>

                <div class="recommendation-card important">
                    <img src="/images/lifestyle.jpg" alt="Lifestyle">
                    <i class="fas fa-running"></i>
                    <h4>Lifestyle Changes</h4>
                    <p>Smoking cessation, heart-healthy diet, regular exercise, and weight management.</p>
                    <div class="card-footer">
                        <i class="fas fa-calendar-check"></i> Ongoing counseling
                    </div>
                </div>

                <div class="recommendation-card standard">
                    <img src="/images/followup.jpg" alt="Follow Up">
                    <i class="fas fa-chart-line"></i>
                    <h4>Follow Up</h4>
                    <p>Regular monitoring of symptoms and risk factors with healthcare provider.</p>
                    <div class="card-footer">
                        <i class="fas fa-sync-alt"></i> Regular follow-up
                    </div>
                </div>
            </div>
        </div>

        <!-- Back Button -->
        <div style="text-align: center; margin-top: 30px;">
            <a href="{{ route('predict.form') }}" class="button" style="display: inline-flex; align-items: center; justify-content: center;">
                <i class="fas fa-arrow-left" style="margin-right: 9px; margin-top: 6px;"></i> Back to Prediction Form
            </a>
        </div>
    </div>

    <!-- Modal for Test Images -->
    <div id="testModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <div id="modalContent">
                <!-- Content will be inserted here by JavaScript -->
            </div>
        </div>
    </div>




    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Animate probability bar and marker
            const fill = document.querySelector('.probability-fill');
            const marker = document.querySelector('.probability-marker');
            const percent = {
                {
                    $percent
                }
            };

            setTimeout(() => {
                fill.style.width = percent + '%';
                marker.style.left = percent + '%';
            }, 300);

            // Highlight the current risk category in the approach grid
            const currentCategoryCard = document.querySelector('.approach-card.{{ $riskCategory }}');
            if (currentCategoryCard) {
                currentCategoryCard.style.transform = 'scale(1.05)';
                currentCategoryCard.style.boxShadow = '0 8px 20px rgba(0,0,0,0.15)';
                currentCategoryCard.style.zIndex = '1';
            }
        });



        // Modal functions
        function openModal(testType) {
            const modal = document.getElementById('testModal');
            const modalContent = document.getElementById('modalContent');

            let title = '';
            let image = '';
            let description = '';
            let urgency = '';
            let icon = '';

            switch (testType) {
                case 'angio':
                    title = 'Invasive Coronary Angiography';
                    image = '/images/angi.jpg';
                    description = 'Invasive coronary angiography is the gold standard for diagnosing CAD. It involves inserting a catheter into the coronary arteries and injecting contrast dye to visualize blockages. This procedure is typically performed in a cardiac catheterization lab and provides the most accurate assessment of coronary artery disease.';
                    urgency = '<i class="fas fa-clock" style="color:#d32f2f"></i> Action required: Immediately';
                    icon = 'fa-procedures';
                    break;
                case 'ccta':
                    title = 'Coronary CT Angiography';
                    image = '/images/ccta.jpg';
                    description = 'CCTA is a non-invasive imaging test that uses CT technology to visualize the coronary arteries. It\'s particularly useful for patients with low to intermediate risk. The test requires intravenous contrast and may not be suitable for patients with kidney impairment or contrast allergies. CCTA provides excellent visualization of coronary artery anatomy and plaque burden.';
                    urgency = '<i class="fas fa-calendar" style="color:#f57c00"></i> Recommended within 1 week';
                    icon = 'fa-lungs';
                    break;
                case 'cmr':
                    title = 'Cardiac MRI';
                    image = '/images/cmr.png';
                    description = 'Cardiac magnetic resonance imaging provides detailed images of the heart structure and function without using ionizing radiation. Excellent for assessing myocardial viability, chamber volumes, and ejection fraction. CMR can detect scar tissue from previous heart attacks and evaluate for other cardiac conditions. Requires patient to lie still in the MRI scanner for 30-60 minutes.';
                    urgency = '<i class="fas fa-calendar" style="color:#ffb300"></i> Consider within 2 weeks';
                    icon = 'fa-magnet';
                    break;
                case 'nuclear':
                    title = 'Nuclear Imaging (SPECT/PET)';
                    image = '/images/SpectAndPet.png';
                    description = 'Nuclear imaging tests (SPECT or PET) use radioactive tracers to assess myocardial perfusion and viability. PET offers better resolution but is less widely available. These tests help evaluate blood flow to the heart muscle and identify areas of reduced perfusion.';
                    urgency = '<i class="fas fa-calendar" style="color:#ffb300"></i> Consider within 2 weeks';
                    icon = 'fa-radiation';
                    break;
                case 'stress':
                    title = 'Stress Testing';
                    image = '/images/stress.png';
                    description = 'Stress tests evaluate how the heart functions during physical exertion or pharmacologic stress. Can be performed with ECG, echo, or nuclear imaging. Exercise stress testing is preferred when possible, but pharmacologic stress may be used for patients unable to exercise adequately. Helps determine if symptoms are due to coronary artery disease and assess functional capacity.';
                    urgency = '<i class="fas fa-calendar" style="color:#7cb342"></i> Consider within 2-4 weeks';
                    icon = 'fa-heartbeat';
                    break;
            }

            modalContent.innerHTML = `
                <h3><i class="fas ${icon}"></i> ${title}</h3>
                <img src="${image}" alt="${title}" class="modal-image">
                <p>${description}</p>
                <div style="margin-top:15px; padding-top:10px; border-top:1px solid #eee;">
                    ${urgency}
                </div>
            `;

            modal.style.display = 'block';
        }

        function closeModal() {
            document.getElementById('testModal').style.display = 'none';
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            const modal = document.getElementById('testModal');
            if (event.target === modal) {
                modal.style.display = 'none';
            }
        }
    </script>
</body>

</html>