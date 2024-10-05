<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'PFMS') }} - Register</title>
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    
    <link rel="shortcut icon" href="{{ asset('logo.png') }}" type="image/x-icon" />

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        vibrantGreen: '#4CAF50',
                        customRed: '#FF5722',
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                }
            }
        }
    </script>
</head>
<body class="bg-vibrantGreen bg-opacity-20 font-sans">
    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="bg-white w-full max-w-md rounded-2xl shadow-lg p-8">
            <h2 class="text-3xl font-bold text-gray-800 mb-6 text-center">Finest</h2>
            
            <form method="POST" action="{{ route('register') }}" id="register">
                @csrf
                
                <!-- Name -->
                <div class="mb-4">
                    <input id="name" type="text" class="w-full px-4 py-3 rounded-lg bg-gray-100 border-transparent focus:border-vibrantGreen focus:bg-white focus:ring-0 text-sm" name="name" value="{{ old('name') }}" required autocomplete="name" placeholder="Full Name" autofocus>
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <input id="email" type="email" class="w-full px-4 py-3 rounded-lg bg-gray-100 border-transparent focus:border-vibrantGreen focus:bg-white focus:ring-0 text-sm" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email">
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <input id="password" type="password" class="w-full px-4 py-3 rounded-lg bg-gray-100 border-transparent focus:border-vibrantGreen focus:bg-white focus:ring-0 text-sm" name="password" required autocomplete="new-password" placeholder="Password">
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="mb-4">
                    <input id="password-confirm" type="password" class="w-full px-4 py-3 rounded-lg bg-gray-100 border-transparent focus:border-vibrantGreen focus:bg-white focus:ring-0 text-sm" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password">
                </div>

                <!-- Job -->
                <div class="mb-6">
                    <input id="job" type="text" class="w-full px-4 py-3 rounded-lg bg-gray-100 border-transparent focus:border-vibrantGreen focus:bg-white focus:ring-0 text-sm" name="job" value="{{ old('job') }}" required placeholder="Job Title">
                    @error('job')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <button type="submit" class="w-full bg-customRed text-white p-3 rounded-lg font-semibold hover:bg-red-700 transition duration-200">
                        Register
                    </button>
                </div>
            </form>
            
            <p class="text-center text-sm text-gray-500">
                Already have an account? 
                <a href="{{ route('login') }}" class="text-customRed hover:underline font-semibold">Login</a>
            </p>
        </div>
    </div>
</body>
</html>