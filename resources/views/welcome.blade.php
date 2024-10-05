<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Finest - Manage Your Money Smartly</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('logo.png') }}" type="image/x-icon" />
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        vibrantGreen: '#d2fad4',
                    }
                }
            }
        }
    </script>
</head>
<body class="antialiased bg-vibrantGreen">
    <div class="min-h-screen flex flex-col">
        <nav class="bg-vibrantGreen shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <img src="{{ asset('icons/finest.png') }}" alt="Finestopia Logo" class="h-8 w-auto mr-2">
                        <span class="text-2xl font-bold text-orange-600">Finest</span>
                    </div>
                    <div class="flex items-center">
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/api/home') }}" class="text-gray-700 hover:text-orange-600">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}" class="text-gray-700 hover:text-orange-600 mr-4">Log in</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="text-white bg-orange-600 hover:bg-orange-700 px-4 py-2 rounded-md">Register</a>
                                @endif
                            @endauth
                        @endif
                    </div>
                </div>
            </div>
        </nav>

        <main class="flex-grow">
            <div class="max-w-7xl mx-auto py-12 sm:px-6 lg:px-8">
                <div class="text-center">
                    <h1 class="text-4xl font-extrabold text-white-900 sm:text-5xl md:text-6xl">
                        <span class="block">Take Control of Your</span>
                        <span class="block text-orange-600">Financial Future</span>
                    </h1>
                    <p class="mt-3 max-w-md mx-auto text-base text-gray-500 sm:text-lg md:mt-5 md:text-xl md:max-w-3xl">
                        Finestopia helps you manage your money effortlessly. Track expenses, set budgets, and reach your financial goals.
                    </p>
                    <div class="mt-5 max-w-md mx-auto sm:flex sm:justify-center md:mt-8">
                        <div class="rounded-md shadow">
                            <a href="#" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-orange-600 hover:bg-orange-700 md:py-4 md:text-lg md:px-10">
                                Get started
                            </a>
                        </div>
                        <div class="mt-3 rounded-md shadow sm:mt-0 sm:ml-3">
                            <a href="#" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-orange-600 bg-white hover:bg-gray-50 md:py-4 md:text-lg md:px-10">
                                Learn more
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <footer class="bg-vibrantGreen">
            <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                <p class="text-center text-gray-500 text-sm">
                    &copy; {{ date('Y') }} Finestopia. All rights reserved.
                </p>
            </div>
        </footer>
    </div>
</body>
</html>