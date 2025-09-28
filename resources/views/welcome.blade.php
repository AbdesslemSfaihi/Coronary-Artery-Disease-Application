<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Coronary Artery Disease Predictor</title>
    <style>
        body,
        html {
            margin: 0;
            padding: 0;
            min-height: 100%;
            overflow-x: hidden;
            font-family: Arial, sans-serif;
        }

        .video-background {
            position: fixed;
            top: 50%;
            left: 50%;
            width: 100vw;
            height: 100vh;
            object-fit: cover;
            transform: translate(-50%, -50%) scale(1.3);
            z-index: -2;
            opacity: 1;
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            height: 0%;
            width: 100%;
            background: rgba(150, 146, 146, 0.5);
            z-index: -1;
        }

        .content {
            position: relative;
            z-index: 1;
            color: white;
            text-align: center;
            padding: 2rem;
        }

        .header {
            margin-top: 3rem;
        }

        .header p {
            font-size: 1rem;
            font-style: italic;
        }

        .section-row {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 3rem;
            padding: 3rem 2rem;
            flex-wrap: wrap;
        }

        .section-row.reverse {
            flex-direction: row-reverse;
        }

        .card-text {
            max-width: 500px;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 15px;
            padding: 2rem;
            backdrop-filter: blur(10px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
            text-align: left;
        }

        .card-text h2 {
            font-size: 2rem;
            margin-bottom: 1rem;
            color: #fff;
        }

        .card-text p {
            font-size: 1.1rem;
            line-height: 1.6;
        }

        .card-image img {
            max-width: 400px;
            border-radius: 15px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.5);
        }

        .cta-button {
            margin: 3rem 0 4rem;
        }

        .cta-button a {
            background-color: rgb(18, 122, 105);
            color: white;
            padding: 0.8rem 1.8rem;
            border-radius: 30px;
            text-decoration: none;
            font-size: 1.3rem;
            transition: background-color 0.3s ease;
        }

        .cta-button a:hover {
            background-color: #00a58a;
        }

        section.how-it-works {
            display: flex;
            justify-content: center;
            padding: 3rem 1rem;
            flex-direction: column;
            align-items: center;
        }

        section.how-it-works .card {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 15px;
            padding: 2rem;
            max-width: 800px;
            backdrop-filter: blur(10px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
            margin-bottom: 1.5rem;
        }

        section.how-it-works .card h2 {
            font-size: 2rem;
            margin-bottom: 1rem;
            color: #fff;
        }

        section.how-it-works .card p {
            font-size: 1.1rem;
            line-height: 1.6;
            color: white;
        }

        .model-performance {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            padding: 1.5rem;
            max-width: 800px;
            backdrop-filter: blur(10px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .stat-item {
            text-align: center;
            min-width: 150px;
        }

        .stat-item h4 {
            margin: 0 0 0.3rem 0;
            font-size: 1.2rem;
            color: rgb(16, 78, 67);
        }

        .stat-item p {
            margin: 0;
            font-size: 1.5rem;
            font-weight: bold;
        }

        .model-footnote {
            font-size: 1rem;
            font-style: italic;
            margin-top: 1rem;
            opacity: 0.8;
        }

        footer {
            width: 100%;
            text-align: center;
            padding: 1.5rem;
            font-size: 0.99rem;
            color: #ddd;
            background: rgba(0, 0, 0, 0.4);
            backdrop-filter: blur(5px);
        }

        @media (max-width: 768px) {

            .section-row,
            .section-row.reverse {
                flex-direction: column !important;
                text-align: center;
            }

            .card-text {
                text-align: center;
            }

            .card-image img {
                width: 100%;
                max-width: 300px;
            }

            .model-performance {
                flex-direction: column;
                align-items: center;
                gap: 1.5rem;
            }
        }

        nav.navbar {
            background: rgba(131, 131, 131, 0.5);
            padding: 1rem 2rem;
            position: fixed;
            width: calc(100% - 65px);
            top: 0;
            left: 0;
            z-index: 10;
            display: flex;
            justify-content: flex-end;
            /* use flex-start for left alignment */
            align-items: center;
            gap: 2rem;
            /* controls spacing between nav items */
            font-family: Arial, sans-serif;
        }

        nav.navbar a,
        nav.navbar span,
        nav.navbar form button {
            color: white;
            text-decoration: none;
            font-size: 1.1rem;
            background: none;
            border: none;
            cursor: pointer;
            font-family: inherit;
            padding: 0;
        }

        nav.navbar form {
            display: inline;
            margin: 0;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar">
        @guest
        <a href="{{ route('login') }}">Login</a>
        <a href="{{ route('register') }}">Register</a>
        @endguest

        @auth
        <span>Hello, {{ auth()->user()->name }}</span>

        @if(auth()->user()->role === 'admin')
        <a href="{{ url('/admin/dash') }}">Dashboard</a>
        @endif

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">Logout</button>
        </form>
        @endauth


    </nav>


    <!-- Background Video -->
    <video autoplay muted loop class="video-background">
        <source src="{{ asset('images/background.mp4') }}" type="video/mp4">
        Your browser does not support the video tag.
    </video>
    <div class="overlay"></div>

    <!-- Page Content -->
    <div class="content">
        <div class="header">
            <h1>Welcome to Our CAD Prediction Platform</h1>
            <p>Empowering early diagnosis through AI-driven medical insight.</p>
        </div>

        <!-- What is CAD Section -->
        <div class="section-row">
            <div class="card-text">
                <h2>What is CAD ?
                </h2>
                <p>Coronary Artery Disease occurs when the coronary arteries that supply the heart muscle become narrowed or blocked due to plaque buildup, potentially leading to heart attacks.</p>
            </div>
            <div class="card-image">
                <img src="{{ asset('images/cad.jpg') }}" alt="What is CAD">
            </div>
        </div>

        <!-- Our Mission Section -->
        <div class="section-row reverse">
            <div class="card-text">
                <h2>Our Mission 🎯</h2>
                <p>We aim to support medical professionals by using artificial intelligence to enable earlier and more accurate detection of CAD. Our tool empowers clinicians and patients alike with predictive insight to improve outcomes.</p>
            </div>
            <div class="card-image">
                <img src="{{ asset('images/mission3.jpg') }}" alt="Mission Image">
            </div>
        </div>

        <!-- How It Works Section -->
        <section class="how-it-works">
            <div class="card">
                <h2>How It Works <span style="font-size: 1.9rem;">❔</span>
                </h2>
                <p>Our model analyzes key medical indicators including blood pressure, cholesterol levels, ECG results, and more. The system then calculates a personalized risk score based on patterns learned from hundreds of real patient profiles.</p>
            </div>

            <br><br>
            <h2>⚡ Model Performance</h2><br>
            <div class="model-performance">
                <div class="stat-item">
                    <h4>✅ Accuracy</h4>
                    <p>0.8280%</p>
                </div>
                <div class="stat-item">
                    <h4>🔍 Recall</h4>
                    <p>0.83%</p>
                </div>
                <div class="stat-item">
                    <h4>📊 F1-score</h4>
                    <p>0.83%</p>
                </div>
                <div class="stat-item">
                    <h4>📈 ROC AUC</h4>
                    <p>0.8652%</p>
                </div>
            </div>
            <p class="model-footnote">*Statistics based on testing with 640+ patient records</p>
        </section>

        <!-- CTA -->
        <div class="cta-button">
            <a href="/predict/form">Try the Model</a>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        All rights reserved © 2025
    </footer>

</body>

</html>