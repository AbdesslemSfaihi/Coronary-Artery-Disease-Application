<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        html,
        body {
            height: 100%;
            margin: 0;
            display: flex;
            flex-direction: column;
        }

        main {
            flex: 1;
            /* Takes up remaining space to push footer down */
        }

        .video-background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            object-fit: cover;
            z-index: -2;
            opacity: 0.8;
        }

        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 100vw;
            z-index: -1;
        }

        .login-wrapper {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-box {
            background-color: white;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
            z-index: 1;
            opacity: 0.95;
        }

        .title {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 1rem;
            color: #333;
        }

        .home-button {
            margin-bottom: 1.5rem;
            padding-right: 260px;
        }

        .home-button a {
            background-color: #4f46e5;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            text-decoration: none;
            font-size: 0.875rem;
            transition: background-color 0.2s;
        }

        .home-button a:hover {
            background-color: #3730a3;
        }


        footer {
            width: 100%;
            text-align: center;
            padding: 1rem;
            font-size: 0.99rem;
            color: #ddd;
            background: rgba(0, 0, 0, 0.4);
            backdrop-filter: blur(5px);
        }
    </style>
</head>

<body>
    <!-- Background Video -->
    <video autoplay muted loop class="video-background">
        <source src="{{ asset('images/background2.mp4') }}" type="video/mp4">
        Your browser does not support the video tag.
    </video>
    <div class="overlay"></div>

    <div class="login-wrapper">
        <!-- Back to Home Button -->
        <div class="home-button">
            <a href="{{ url('/') }}">← Back to Home</a>
        </div>

        <!-- Login Box -->
        <div class="login-box">
            <!-- Title -->
            <div class="title text-center">Login Form</div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" class="block mt-1 w-full"
                        type="password"
                        name="password"
                        required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                        <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                    </label>
                </div>

                <!-- Forgot Password & Log In -->
                <div class="flex items-center justify-center mt-4 space-x-8">
                    @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                    @endif

                    <x-primary-button>
                        {{ __('Log in') }}
                    </x-primary-button>
                </div>
            </form>

            <!-- Register Redirect -->
            <div class="mt-4 text-center">
                <span class="text-sm text-gray-600">Don't have an account?</span>
                <a href="{{ route('register') }}" class="ml-2 inline-block text-indigo-600 hover:underline font-semibold">
                    Register
                </a>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        All rights reserved © 2025
    </footer>
</body>

</html>