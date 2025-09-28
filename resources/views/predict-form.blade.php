<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Model Prediction</title>
    <style>
        body {
            position: relative;
            font-family: Arial, sans-serif;
            background-color: #f4f6f8;
            margin: 0;
            padding: 20px;
            z-index: 0;
        }

        body::before {
            content: "";
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            /*background-image: url('/images/cad9.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center center;
            opacity: 0.9;
            z-index: -1;
            */
        }


        h1 {
            text-align: center;
            color: #333;
        }

        form {
            max-width: 1100px;
            margin: auto;
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            opacity: 0.95;
        }

        .form-row {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 20px;
        }

        .form-group {
            flex: 1;
            min-width: 250px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="text"],
        select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
        }

        .buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
            gap: 15px;
        }

        .buttons button {
            flex: 1;
            max-width: 200px;
            padding: 12px 25px;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        #prevBtn {
            background-color: #6c757d;
            color: white;
        }

        #prevBtn:hover {
            background-color: #5a6268;
            transform: translateY(-2px);
            box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
        }

        #nextBtn,
        #submitBtn {
            background-color: #007bff;
            color: white;
            margin-left: auto;
            /* Align to right */
        }

        #nextBtn:hover,
        #submitBtn:hover {
            background-color: #0069d9;
            transform: translateY(-2px);
            box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
        }

        /* Add icons to buttons */
        .buttons button::before {
            font-family: "Font Awesome 6 Free";
            font-weight: 900;
            margin-right: 8px;
            font-size: 0.9em;
        }

        #prevBtn::before {
            content: "\f060";
            /* fa-arrow-left */
        }

        #nextBtn::before {
            content: "\f061";
            /* fa-arrow-right */
        }

        #submitBtn::before {
            content: "\f0a9";
            /* fa-paper-plane */
        }

        /* Disabled state */
        .buttons button:disabled {
            background-color: #e9ecef;
            color: #6c757d;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .buttons {
                flex-direction: column;
            }

            .buttons button {
                max-width: 100%;
                width: 100%;
            }

            #nextBtn,
            #submitBtn {
                margin-left: 0;
                margin-top: 10px;
            }
        }

        .step {
            display: none;
        }

        .step.active {
            display: block;
        }

        #progress-container {
            width: 100%;
            background-color: #e0e0e0;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        #progress-bar {
            height: 12px;
            background-color: #28a745;
            border-radius: 10px;
            width: 0%;
            transition: width 0.3s ease-in-out;
        }

        .step-label {
            font-size: 1.2em;
            font-weight: bold;
            margin-bottom: 10px;
            color: #444;
        }

        input.invalid,
        select.invalid {
            border: 2px solid red;
            background-color: #ffe6e6;
        }

        .invalid {
            border: 2px solid red;
        }

        input.invalid::placeholder {
            color: red;
        }

        .error-message {
            color: red;
            font-size: 0.9em;
            margin-top: 5px;
        }

        .card-style {
            padding: 15px;
            background: rgb(255, 255, 255);
            border: 2px solid #007bff;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 123, 255, 0.1);
            transition: transform 0.2s ease-in-out;
        }

        .card-style:hover {
            transform: translateY(-5px);
        }

        /* Improved Step 1: Demographic Information */
        .step.active {
            animation: fadeIn 0.5s ease-in-out;
        }

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

        .step-label {
            font-size: 1.3em;
            font-weight: 600;
            margin-bottom: 25px;
            color: #2c3e50;
            position: relative;
            padding-left: 15px;
        }

        .step-label::before {
            content: '';
            position: absolute;
            left: 0;
            top: 5px;
            height: 70%;
            width: 4px;
            background-color: #3498db;
            border-radius: 2px;
        }

        .form-row {
            display: flex;
            flex-wrap: wrap;
            gap: 30px;
            margin-bottom: 20px;
        }

        /* Age Card - Modern Redesign */
        .age-card {
            flex: 1;
            min-width: 250px;
            padding: 25px;
            background: linear-gradient(135deg, #f5f7fa 0%, #e4e8f0 100%);
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            border: 1px solid rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .age-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        .age-card::after {
            content: 'AGE';
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 0.8rem;
            font-weight: bold;
            color: rgba(0, 0, 0, 0.1);
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .age-card label {
            display: block;
            font-weight: 600;
            margin-bottom: 15px;
            color: #2c3e50;
            font-size: 1.1rem;
        }

        .age-input-container {
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .age-card input[type="number"] {
            appearance: textfield;
            -webkit-appearance: textfield;
            -moz-appearance: textfield;
            width: 120px;
            padding: 15px;
            font-size: 2rem;
            font-weight: bold;
            text-align: center;
            color: #3498db;
            border: 2px solid #e0e3e7;
            border-radius: 12px;
            background-color: white;
            transition: all 0.3s ease;
            box-shadow: inset 0 2px 5px rgba(0, 0, 0, 0.05);
        }


        .age-card input[type="number"]:hover {
            border-color: #bdc3c7;
        }

        .age-card input[type="number"]:focus {
            border-color: #3498db;
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2);
            outline: none;
        }

        /* Hide number input arrows */
        .age-card input[type="number"]::-webkit-outer-spin-button,
        .age-card input[type="number"]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .age-unit {
            position: absolute;
            right: 100px;
            font-size: 1rem;
            color: #7f8c8d;
            font-weight: 500;
        }

        /* Gender Card - Keeping your existing style with minor improvements */
        .gender-card {
            flex: 1;
            min-width: 250px;
            padding: 25px;
            background: linear-gradient(135deg, #f5f7fa 0%, #e4e8f0 100%);
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            border: 1px solid rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .gender-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        .gender-card::after {
            content: 'GENDER';
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 0.8rem;
            font-weight: bold;
            color: rgba(0, 0, 0, 0.1);
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .gender-card label {
            display: block;
            font-weight: 600;
            margin-bottom: 15px;
            color: #2c3e50;
            font-size: 1.1rem;
        }

        .gender-card select {
            width: 100%;
            padding: 12px 15px;
            font-size: 1rem;
            border: 2px solid #e0e3e7;
            border-radius: 10px;
            background-color: white;
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 10px center;
            background-size: 1em;
            transition: all 0.3s ease;
        }

        .gender-card select:focus {
            border-color: #3498db;
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2);
            outline: none;
        }

        #gender-symbol {
            margin-top: 15px;
            font-size: 2.5em;
            text-align: center;
            transition: all 0.3s ease;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        #gender-card.male {
            background: linear-gradient(135deg, #e6f0ff 0%, #cce0ff 100%);
            border-color: #3498db;
        }

        #gender-card.female {
            background: linear-gradient(135deg, #ffe6f0 0%, #ffccdd 100%);
            border-color: #e91e63;
        }


        /*Age
        .card-style input[type="number"] {
            font-size: 1.6rem;
            padding: 12px;
            width: 120px;
            margin-left: 110px;
            height: 50px;
            border: 1px solid #ccc;
            border-radius: 12px;
            background-color: #f9f9f9;
            text-align: center;
            color: #333;
            transition: all 0.2s ease-in-out;
            appearance: none;
        }

        .card-style input[type="number"]:hover {
            border-color: #007bff;
            background-color: #f1faff;
        }

        .card-style input[type="number"]:focus {
            border-color: #007bff;
            outline: none;
            background-color: #e6f2ff;
        }
            */



        /* Remove default spin buttons (optional on Chrome) */
        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            height: 40px;
            width: 20px;
        }

        #gender-symbol {
            margin-top: 10px;
            font-size: 2em;
            font-weight: bold;
            text-align: center;
        }

        #gender-card.female {
            background-color: #ffe6f0;
            border-color: rgb(255, 21, 21);
        }

        #gender-card.male {
            background-color: #e6f0ff;
            border-color: #007bff;
        }

        .card-style.icon-select {
            background-color: rgb(255, 255, 255);
            border: 1px solid #ddd;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        }

        .card-style.icon-select label {
            display: block;
            font-weight: bold;
            margin-bottom: 10px;
            color: #333;
            font-size: 1.1rem;
        }

        .card-style.icon-select i {
            margin-right: 8px;
            color: #007bff;
        }

        .card-style select {
            width: 100%;
            padding: 10px;
            font-size: 1rem;
            border-radius: 8px;
            border: 1px solid #ccc;
            background-color: #f9f9f9;
            transition: 0.2s ease-in-out;
        }

        .card-style select:focus {
            border-color: #007bff;
            background-color: #eef6ff;
            outline: none;
        }

        .toggle-group {
            display: flex;
            justify-content: space-between;
            flex-wrap: nowrap;
            /* Ensures all are in one row */
            gap: 1rem;
        }

        .toggle-card {
            flex: 1;
            /* Allow cards to evenly share space */
            max-width: 32%;
            border: 1px solid #ccc;
            border-radius: 12px;
            padding: 1rem;
            background-color: #f9f9f9;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .toggle-label {
            font-weight: bold;
            margin-bottom: 0.5rem;
            display: block;
            font-size: 1.1rem;
        }

        .toggle-options {
            display: flex;
            justify-content: space-around;
            margin-top: 0.5rem;
        }

        .toggle-option {
            cursor: pointer;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 0.5rem;
            border: 2px solid transparent;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .toggle-option:hover,
        input[type="radio"]:checked+.toggle-option {
            border-color: #007bff;
            background-color: #e6f0ff;
        }

        .toggle-option i {
            font-size: 1.5rem;
            margin-bottom: 0.3rem;
            color: #007bff;
            /* Set icon color to blue */
        }

        /* Updated Step 4: Blood Tests (Lipid Profile) */
        .lipid-panel {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }

        .lipid-card {
            flex: 1;
            min-width: 220px;
            max-width: 300px;
            padding: 20px;
            border-radius: 12px;
            background: linear-gradient(145deg, #f8f9fa, #ffffff);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            border: 1px solid #e0e3e7;
        }

        .lipid-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.12);
        }

        .lipid-header {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 1px dashed #d1d5db;
        }

        .lipid-icon {
            font-size: 1.5rem;
            margin-right: 12px;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            color: #3b82f6;
        }

        /* Unique icon colors for each test */
        .icon-ct {
            background: #e6f0ff;
        }

        .icon-tg {
            background: #fff2e6;
            color: #f97316;
        }

        .icon-hdl {
            background: #f0fdf4;
            color: #10b981;
        }

        .lipid-title {
            font-weight: 600;
            font-size: 1.1rem;
            color: #2d3748;
        }

        .lipid-input-container {
            position: relative;
        }

        .lipid-input {
            width: 90%;
            padding: 12px 15px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 1rem;
            background-color: #f9fafb;
            transition: all 0.3s;
        }

        .lipid-input:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
            outline: none;
        }

        .lipid-unit {
            position: absolute;
            right: 25px;
            top: 50%;
            transform: translateY(-50%);
            color: #64748b;
            font-size: 0.9rem;
        }

        /* Step 5: Blood Tests (Additional Labs) - New Style */
        .advanced-blood-panel {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }

        .advanced-lab-card {
            flex: 1;
            min-width: 220px;
            max-width: 300px;
            padding: 20px;
            border-radius: 12px;
            background: linear-gradient(145deg, #f8f9fa, #ffffff);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            border: 1px solid #e0e3e7;
        }

        .advanced-lab-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.12);
        }

        .lab-card-header {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 1px dashed #d1d5db;
        }

        .lab-icon {
            font-size: 1.5rem;
            margin-right: 12px;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: #e6f0ff;
            color: #3b82f6;
        }

        .lab-title {
            font-weight: 600;
            font-size: 1.1rem;
            color: #2d3748;
        }

        .lab-input-container {
            position: relative;
        }

        .lab-input {
            width: 90%;
            padding: 12px 15px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 1rem;
            background-color: #f9fafb;
            transition: all 0.3s;
        }

        .lab-input:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
            outline: none;
        }

        .input-unit {
            position: absolute;
            right: 25px;
            top: 50%;
            transform: translateY(-50%);
            color: #64748b;
            font-size: 0.9rem;
        }

        /* Step 6: Physical Measurements - Interactive Dashboard Style */
        .vitals-dashboard {
            display: grid;
            grid-template-columns: 1fr 1fr;
            grid-template-rows: auto auto;
            gap: 20px;
            max-width: 800px;
            margin: 0 auto;
        }

        .vital-widget {
            background: white;
            border-radius: 16px;
            padding: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        /* Make BMI span full width */
        .bmi-widget {
            grid-column: span 2;
            background: linear-gradient(135deg, #f5f7fa 0%, #e4e8f0 100%);
        }

        .vital-header {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .vital-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            font-size: 1.5rem;
            color: white;
        }

        /* Unique icon colors */
        .bmi-icon {
            background-color: #6366f1;
        }

        .systolic-icon {
            background-color: #ef4444;
        }

        .diastolic-icon {
            background-color: #10b981;
        }

        .vital-title {
            font-weight: 600;
            font-size: 1.1rem;
            color: #2d3748;
        }

        .vital-input-group {
            display: flex;
            align-items: center;
        }

        .vital-input {
            flex: 1;
            padding: 14px 16px;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            font-size: 1.1rem;
            text-align: center;
            transition: all 0.3s;
        }

        .vital-input:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.15);
            outline: none;
        }

        .vital-unit {
            margin-left: 10px;
            font-weight: 500;
            color: #64748b;
            min-width: 50px;
        }

        /* Blood pressure specific styling */
        .bp-widgets {
            display: flex;
            gap: 20px;
        }

        .bp-input-container {
            display: flex;
            align-items: center;
        }

        .bp-separator {
            margin: 0 10px;
            font-size: 1.5rem;
            color: #94a3b8;
        }

        /* BMI specific styling */
        .bmi-scale {
            height: 8px;
            background: #e2e8f0;
            border-radius: 4px;
            margin-top: 15px;
            position: relative;
            overflow: hidden;
        }

        .bmi-indicator {
            position: absolute;
            height: 100%;
            background: linear-gradient(90deg, #4ade80, #f59e0b, #ef4444);
            width: 100%;
        }

        .bmi-labels {
            display: flex;
            justify-content: space-between;
            margin-top: 5px;
            font-size: 0.8rem;
            color: #64748b;
        }


        /* Step 7: Symptoms & Diagnostics - Clinical Console Style */
        .clinical-console {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            max-width: 900px;
            margin: 0 auto;
            background: #f8fafc;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
            border: 1px solid #e2e8f0;
        }

        .clinical-panel {
            background: white;
            border-radius: 16px;
            padding: 25px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            position: relative;
            overflow: hidden;
        }

        .clinical-panel::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 5px;
            height: 100%;
            background: #3b82f6;
        }

        .symptom-panel::before {
            background: #ef4444;
            /* Red for symptoms */
        }

        .ecg-panel::before {
            background: #10b981;
            /* Green for diagnostics */
        }

        .panel-header {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px dashed #e2e8f0;
        }

        .panel-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            font-size: 1.5rem;
            color: white;
        }

        .symptom-icon {
            background-color: #ef4444;
        }

        .ecg-icon {
            background-color: #10b981;
        }

        .panel-title {
            font-weight: 600;
            font-size: 1.2rem;
            color: #1e293b;
        }

        /* Pain Symptom Toggle */
        .symptom-toggle {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .toggle-option {
            display: flex;
            align-items: center;
            padding: 12px 15px;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s;
            border: 2px solid #e2e8f0;
        }

        .toggle-option:hover {
            background: #f1f5f9;
        }

        input[type="radio"]:checked+.toggle-option {
            border-color: #3b82f6;
            background: #eff6ff;
        }

        .toggle-icon {
            margin-right: 10px;
            font-size: 1.2rem;
            width: 24px;
            text-align: center;
        }

        .toggle-label {
            font-weight: 500;
        }

        /* ECG Input */
        .ecg-input-container {
            position: relative;
        }

        .ecg-input {
            width: 90%;
            padding: 14px 16px;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            font-size: 1.1rem;
            background: #f8fafc;
            transition: all 0.3s;
        }

        .ecg-input:focus {
            border-color: #10b981;
            box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.15);
            outline: none;
        }

        .ecg-unit {
            position: absolute;
            right: 25px;
            top: 50%;
            transform: translateY(-50%);
            color: #64748b;
            font-weight: 500;
        }

        /* Animated ECG Line */
        .ecg-visual {
            height: 60px;
            margin-top: 20px;
            background: #f1f5f9;
            border-radius: 8px;
            position: relative;
            overflow: hidden;
        }

        .ecg-line {
            position: absolute;
            top: 50%;
            left: 0;
            width: 100%;
            height: 2px;
            background: #10b981;
        }

        .ecg-peak {
            position: absolute;
            background: #ef4444;
            width: 3px;
            height: 20px;
            animation: ecgBeat 1.5s infinite;
        }

        @keyframes ecgBeat {

            0%,
            100% {
                height: 20px;
            }

            50% {
                height: 40px;
            }
        }

        #step-indicator {
            text-align: center;
            margin: 10px 0 20px;
            font-size: 1.1em;
            color: #555;
            font-weight: bold;
        }
    </style>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

</head>

<body>
    <div style="text-align: left; margin-bottom: 20px;">
        <a href="{{ url('/') }}" style="
    display: inline-block;
    padding: 10px 20px;
    background-color:rgb(25, 150, 129);
    color: white;
    text-decoration: none;
    border-radius: 8px;
    font-weight: bold;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    transition: background-color 0.3s ease;
    position: relative;
    z-index: 1000; /* Add this line */
">🏠 Home Page</a>
    </div>


    <h1>Enter Patient Data</h1>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif


    <form method="POST" action="/predict-form">
        @csrf

        <!-- Progress Bar -->
        <div id="progress-container">
            <div id="progress-bar"></div>
        </div>
        <div id="step-indicator">Step 1 of 7</div> <!-- Add this line -->


        <!-- Step 1: Demographic Information - Improved Version -->
        <div class="step active">
            <div class="step-label">Step 1: Demographic Information</div>
            <div class="form-row">
                <!-- Age Card - Redesigned -->
                <div class="form-group age-card" id="age-card">
                    <label>Age:</label>
                    <div class="age-input-container">
                        <input type="number" name="Age" class="required-input numeric-input"
                            value="{{ old('Age', 50) }}" min="1" max="120" step="1">
                        <span class="age-unit">years</span>
                    </div>
                    <div class="error-message"></div>
                </div>

                <!-- Gender Card - Slightly Enhanced -->
                <div class="form-group gender-card" id="gender-card">
                    <label>Sex:</label>
                    <select name="Sexe" id="gender-select" class="required-input">
                        <option value="">Select gender...</option>
                        <option value="0" {{ old('Sexe') == '0' ? 'selected' : '' }}>👩 Female</option>
                        <option value="1" {{ old('Sexe') == '1' ? 'selected' : '' }}>👨 Male</option>
                    </select>
                    <div class="gender-symbol" id="gender-symbol"></div>
                    <div class="error-message"></div>
                </div>
            </div>
        </div>

        <!-- Step 2: Medical History (Part 1) -->
        <div class="step">
            <div class="step-label">Step 2: Medical History (Part 1)</div>
            <div class="form-row">
                <div class="form-group card-style icon-select">
                    <label for="coronaropathie">
                        <i class="fas fa-heartbeat"></i> Coronaropathie familiale:
                    </label>
                    <select name="coronaropathie" id="coronaropathie" required>
                        <option value="" disabled selected>Choose...</option>
                        <option value="0">No</option>
                        <option value="1">Yes</option>
                    </select>
                    <div class="error-message"></div>
                </div>

                <div class="form-group card-style icon-select">
                    <label for="Habitudes_Tabagisme">
                        <i class="fas fa-smoking"></i> Tabagisme:
                    </label>
                    <select name="Habitudes_Tabagisme" id="Habitudes_Tabagisme" required>
                        <option value="" disabled selected>Choose...</option>
                        <option value="0">🚭 No</option>
                        <option value="1">🚬 Yes</option>
                    </select>
                    <div class="error-message"></div>
                </div>
            </div>
        </div>

        <!-- Step 3: Medical History (Part 2) -->
        <div class="step">
            <div class="step-label">Step 3: Medical History (Part 2)</div>
            <div class="form-row toggle-group">
                @foreach ([
                'Diabete' => 'fa-syringe',
                'HTA' => 'fa-heart',
                'Hypercholestérolémie' => 'fa-vials'
                ] as $field => $icon)
                <div class="toggle-card">
                    <label class="toggle-label">{{ $field }}</label>
                    <div class="toggle-options">
                        <input type="radio" id="{{ $field }}-yes" name="{{ $field }}" value="1" {{ old($field) == '1' ? 'checked' : '' }} required>
                        <label for="{{ $field }}-yes" class="toggle-option">
                            <i class="fas {{ $icon }}"></i>
                            <span>Yes</span>
                        </label>

                        <input type="radio" id="{{ $field }}-no" name="{{ $field }}" value="0" {{ old($field) == '0' ? 'checked' : '' }} required>
                        <label for="{{ $field }}-no" class="toggle-option">
                            <i class="fas fa-times-circle"></i>
                            <span>No</span>
                        </label>
                    </div>
                    <div class="error-message" id="{{ $field }}-error"></div>
                </div>
                @endforeach
            </div>
        </div>


        <!-- Step 4: Blood Tests (Lipid Profile) -->
        <div class="step">
            <div class="step-label">Step 4: Lipid Profile</div>
            <div class="form-row lipid-panel">
                <!-- Total Cholesterol Card -->
                <div class="form-group lipid-card">
                    <div class="lipid-header">
                        <div class="lipid-icon icon-ct">
                            <i class="fas fa-chart-pie"></i>
                        </div>
                        <div class="lipid-title">Total Cholesterol</div>
                    </div>
                    <div class="lipid-input-container">
                        <input type="number" step="0.01" name="Biologie_CT"
                            class="required-input numeric-input lipid-input"
                            placeholder="Enter value">
                        <span class="lipid-unit">mg/dL</span>
                    </div>
                    <div class="error-message"></div>
                </div>

                <!-- Triglycerides Card -->
                <div class="form-group lipid-card">
                    <div class="lipid-header">
                        <div class="lipid-icon icon-tg">
                            <i class="fas fa-fire"></i>
                        </div>
                        <div class="lipid-title">Triglycerides</div>
                    </div>
                    <div class="lipid-input-container">
                        <input type="number" step="0.01" name="Biologie_TG"
                            class="required-input numeric-input lipid-input"
                            placeholder="Enter value">
                        <span class="lipid-unit">mg/dL</span>
                    </div>
                    <div class="error-message"></div>
                </div>

                <!-- HDL Cholesterol Card -->
                <div class="form-group lipid-card">
                    <div class="lipid-header">
                        <div class="lipid-icon icon-hdl">
                            <i class="fas fa-heartbeat"></i>
                        </div>
                        <div class="lipid-title">HDL Cholesterol</div>
                    </div>
                    <div class="lipid-input-container">
                        <input type="number" step="0.01" name="HDL_C"
                            class="required-input numeric-input lipid-input"
                            placeholder="Enter value">
                        <span class="lipid-unit">mg/dL</span>
                    </div>
                    <div class="error-message"></div>
                </div>
            </div>
        </div>


        <!-- Step 5: Blood Tests (Additional Labs) -->
        <div class="step">
            <div class="step-label">Step 5: Advanced Blood Tests</div>
            <div class="form-row advanced-blood-panel">
                <!-- LDL Card -->
                <div class="form-group advanced-lab-card">
                    <div class="lab-card-header">
                        <div class="lab-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <div class="lab-title">LDL Cholesterol</div>
                    </div>
                    <div class="lab-input-container">
                        <input type="number" step="0.01" name="LDL_C"
                            class="required-input numeric-input lab-input"
                            placeholder="Enter value">
                        <span class="input-unit">mg/dL</span>
                    </div>
                    <div class="error-message"></div>
                </div>

                <!-- Glucose Card -->
                <div class="form-group advanced-lab-card">
                    <div class="lab-card-header">
                        <div class="lab-icon">
                            <i class="fas fa-flask"></i>
                        </div>
                        <div class="lab-title">Glucose</div>
                    </div>
                    <div class="lab-input-container">
                        <input type="number" step="0.01" name="Biologie_GAJ"
                            class="required-input numeric-input lab-input"
                            placeholder="Enter value">
                        <span class="input-unit">mg/dL</span>
                    </div>
                    <div class="error-message"></div>
                </div>

                <!-- Creatinine Card -->
                <div class="form-group advanced-lab-card">
                    <div class="lab-card-header">
                        <div class="lab-icon">
                            <i class="fas fa-vial"></i>
                        </div>
                        <div class="lab-title">Creatinine</div>
                    </div>
                    <div class="lab-input-container">
                        <input type="number" step="0.01" name="Biologie_Créatinémie"
                            class="required-input numeric-input lab-input"
                            placeholder="Enter value">
                        <span class="input-unit">mg/dL</span>
                    </div>
                    <div class="error-message"></div>
                </div>
            </div>
        </div>

        <!-- Step 6: Physical Measurements - New HTML -->
        <div class="step">
            <div class="step-label">Step 6: Physical Measurements Dashboard</div>
            <div class="form-row">
                <div class="vitals-dashboard">
                    <!-- BMI Widget (Full width) -->
                    <div class="vital-widget bmi-widget">
                        <div class="vital-header">
                            <div class="vital-icon bmi-icon">
                                <i class="fas fa-weight"></i>
                            </div>
                            <div class="vital-title">Body Mass Index (BMI)</div>
                        </div>
                        <div class="vital-input-group">
                            <input type="number" step="0.1" name="IMC"
                                class="required-input numeric-input vital-input"
                                placeholder="00.0">
                            <span class="vital-unit">kg/m²</span>
                        </div>
                        <div class="bmi-scale">
                            <div class="bmi-indicator"></div>
                        </div>
                        <div class="bmi-labels">
                            <span>Underweight (&lt;18.5)</span>
                            <span>Normal (18.5-25)</span>
                            <span>Overweight (25-30)</span>
                            <span>Obese (&gt;30)</span>
                        </div>
                        <div class="error-message"></div>
                    </div>

                    <!-- Blood Pressure Widgets -->
                    <div class="vital-widget">
                        <div class="vital-header">
                            <div class="vital-icon systolic-icon">
                                <i class="fas fa-heart-pulse"></i>
                            </div>
                            <div class="vital-title">Systolic Pressure</div>
                        </div>
                        <div class="vital-input-group">
                            <input type="number" name="PA_systolic"
                                class="required-input numeric-input vital-input"
                                placeholder="18">
                            <span class="vital-unit">mmHg</span>
                        </div>
                        <div class="error-message"></div>
                    </div>

                    <div class="vital-widget">
                        <div class="vital-header">
                            <div class="vital-icon diastolic-icon">
                                <i class="fas fa-heart"></i>
                            </div>
                            <div class="vital-title">Diastolic Pressure</div>
                        </div>
                        <div class="vital-input-group">
                            <input type="number" name="PA_diastolic"
                                class="required-input numeric-input vital-input"
                                placeholder="8">
                            <span class="vital-unit">mmHg</span>
                        </div>
                        <div class="error-message"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Step 7: Symptoms & Diagnostics - New HTML -->
        <div class="step">
            <div class="step-label">Step 7: Clinical Assessment</div>
            <div class="form-row">
                <div class="clinical-console">
                    <!-- Symptoms Panel -->
                    <div class="clinical-panel symptom-panel">
                        <div class="panel-header">
                            <div class="panel-icon symptom-icon">
                                <i class="fas fa-exclamation-triangle"></i>
                            </div>
                            <div class="panel-title">Pain Symptom</div>
                        </div>
                        <div class="symptom-toggle">
                            <input type="radio" id="pain-no" name="Symptomes_Douleur" value="0" required>
                            <label for="pain-no" class="toggle-option">
                                <span class="toggle-icon">✅</span>
                                <span class="toggle-label">No Chest Pain</span>
                            </label>

                            <input type="radio" id="pain-yes" name="Symptomes_Douleur" value="1" required>
                            <label for="pain-yes" class="toggle-option">
                                <span class="toggle-icon">⚠️</span>
                                <span class="toggle-label">Chest Pain Present</span>
                            </label>
                        </div>
                        <div class="error-message"></div>
                    </div>

                    <!-- ECG Panel -->
                    <div class="clinical-panel ecg-panel">
                        <div class="panel-header">
                            <div class="panel-icon ecg-icon">
                                <i class="fas fa-heartbeat"></i>
                            </div>
                            <div class="panel-title">ECG Reading</div>
                        </div>
                        <div class="ecg-input-container">
                            <input type="number" name="ECG_FrequenceCardiaque"
                                class="required-input numeric-input ecg-input"
                                placeholder="Enter heart rate">
                            <span class="ecg-unit">BPM</span>
                        </div>
                        <div class="ecg-visual">
                            <div class="ecg-line"></div>
                            <div class="ecg-peak" style="left: 20%;"></div>
                            <div class="ecg-peak" style="left: 40%;"></div>
                            <div class="ecg-peak" style="left: 60%;"></div>
                            <div class="ecg-peak" style="left: 80%;"></div>
                        </div>
                        <div class="error-message"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Navigation Buttons (Must be outside all .step divs) -->
        <div class="buttons">
            <button type="button" id="prevBtn" style="display: none;">Previous</button>
            <button type="button" id="nextBtn">Next</button>
            <button type="submit" id="submitBtn" style="display: none;">Predict</button>
        </div>
    </form>



    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const steps = document.querySelectorAll('.step');
            const nextBtn = document.getElementById('nextBtn');
            const prevBtn = document.getElementById('prevBtn');
            const submitBtn = document.getElementById('submitBtn');
            const progressBar = document.getElementById('progress-bar');
            let currentStep = 0;

            function showStep(index) {
                steps.forEach((step, i) => {
                    step.classList.toggle('active', i === index);
                });

                prevBtn.style.display = index === 0 ? 'none' : 'inline-block';
                nextBtn.style.display = index === steps.length - 1 ? 'none' : 'inline-block';
                submitBtn.style.display = index === steps.length - 1 ? 'inline-block' : 'none';

                const percent = ((index + 1) / steps.length) * 100;
                progressBar.style.width = percent + '%';

                // Update step indicator text
                document.getElementById('step-indicator').textContent = `Step ${index + 1} of ${steps.length}`;
            }

            function validateStep(step) {
                const currentInputs = steps[step].querySelectorAll('.required-input, select[required], textarea[required], input[type="radio"][required]');
                let valid = true;

                // First check all regular inputs
                currentInputs.forEach(input => {
                    if (input.type !== 'radio') {
                        const value = input.value.trim();
                        const parent = input.parentElement;
                        const errorDiv = parent.querySelector('.error-message');
                        const isNumericField = input.classList.contains('numeric-input');
                        const isNotNumeric = isNumericField && isNaN(value);
                        const name = input.name;
                        const numValue = parseFloat(value);

                        input.classList.remove('invalid');
                        if (errorDiv) errorDiv.textContent = '';

                        if (value === '') {
                            input.classList.add('invalid');
                            if (errorDiv) errorDiv.textContent = 'This field is required.';
                            valid = false;
                            return;
                        }

                        if (isNumericField && isNotNumeric) {
                            input.classList.add('invalid');
                            if (errorDiv) errorDiv.textContent = 'Must be a valid number.';
                            valid = false;
                            return;
                        }

                        if (
                            (name === 'Age' && (numValue <= 0 || numValue > 120)) ||
                            (name === 'IMC' && (numValue < 0 || numValue > 100)) ||
                            (name === 'PA_systolic' && (numValue < 0 || numValue > 300)) ||
                            (name === 'PA_diastolic' && (numValue < 0 || numValue > 200)) ||
                            (name === 'ECG_FrequenceCardiaque' && (numValue < 0 || numValue > 250))
                        ) {
                            input.classList.add('invalid');
                            if (errorDiv) errorDiv.textContent = 'Value is out of valid range.';
                            valid = false;
                        }
                    }
                });

                // Then check radio button groups
                const radioGroups = {};
                steps[step].querySelectorAll('input[type="radio"][required]').forEach(radio => {
                    if (!radioGroups[radio.name]) {
                        radioGroups[radio.name] = {
                            checked: false,
                            errorDiv: document.getElementById(`${radio.name}-error`)
                        };
                    }
                    if (radio.checked) {
                        radioGroups[radio.name].checked = true;
                    }
                });

                for (const groupName in radioGroups) {
                    if (!radioGroups[groupName].checked) {
                        if (radioGroups[groupName].errorDiv) {
                            radioGroups[groupName].errorDiv.textContent = 'Please select an option';
                        }
                        valid = false;
                    } else if (radioGroups[groupName].errorDiv) {
                        radioGroups[groupName].errorDiv.textContent = '';
                    }
                }

                return valid;
            }

            nextBtn.addEventListener('click', function() {
                if (validateStep(currentStep)) {
                    currentStep++;
                    showStep(currentStep);
                }
            });

            prevBtn.addEventListener('click', function() {
                currentStep--;
                showStep(currentStep);
            });

            showStep(currentStep); // Initialize

            const genderSelect = document.getElementById('gender-select');
            const genderCard = document.getElementById('gender-card');
            const genderSymbol = document.getElementById('gender-symbol');

            genderSelect.addEventListener('change', function() {
                const value = this.value;
                genderCard.classList.remove('male', 'female');
                genderSymbol.textContent = '';

                if (value === '0') {
                    genderCard.classList.add('female');
                    genderSymbol.textContent = '👩';
                } else if (value === '1') {
                    genderCard.classList.add('male');
                    genderSymbol.textContent = '👨';
                }

            });

        });
    </script>
</body>

</html>