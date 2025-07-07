<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* Menggunakan font Inter sebagai default */
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100 dark:bg-gray-900">

    <div class="flex min-h-screen items-center justify-center px-4">
        <div class="w-full max-w-md space-y-8">
            
            <!-- Login Card -->
            <div class="bg-white dark:bg-gray-800 p-8 md:p-10 rounded-2xl shadow-2xl shadow-gray-900/10 dark:shadow-black/20">
                <div class="text-center">
                    <h1 class="text-3xl font-bold tracking-tight text-gray-900 dark:text-white">
                        Admin Area
                    </h1>
                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                        Please sign in to access the dashboard.
                    </p>
                </div>

                <!-- Pesan Error dari Laravel -->
                @if ($errors->any())
                <div class="bg-red-100 dark:bg-red-500/20 border border-red-400 dark:border-red-500 text-red-700 dark:text-red-300 px-4 py-3 rounded-lg relative mt-6" role="alert">
                    <strong class="font-bold">Oops!</strong>
                    {{-- Menampilkan error pertama yang ditemukan, biasanya untuk login --}}
                    <span class="block sm:inline">{{ $errors->first() }}</span>
                </div>
                @endif


                <form class="mt-8 space-y-6" action="{{ route('admin.login.submit') }}" method="POST">
                    @csrf
                    <div class="space-y-4">
                        <!-- Email Input -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Email address
                            </label>
                            <div class="mt-1">
                                <input id="email" name="email" type="email" autocomplete="email" required value="{{ old('email') }}"
                                    class="appearance-none block w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg placeholder-gray-400 dark:placeholder-gray-500 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition @error('email') border-red-500 @enderror">
                            </div>
                        </div>

                        <!-- Password Input -->
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Password
                            </label>
                            <div class="mt-1">
                                <input id="password" name="password" type="password" autocomplete="current-password" required
                                    class="appearance-none block w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg placeholder-gray-400 dark:placeholder-gray-500 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition @error('password') border-red-500 @enderror">
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div>
                        <button type="submit"
                            class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-semibold rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 dark:focus:ring-offset-gray-800 focus:ring-blue-500 transition-transform transform hover:scale-105">
                            Sign In
                        </button>
                    </div>
                </form>
            </div>
            
            <p class="text-center text-sm text-gray-500 dark:text-gray-400">
                &copy; {{ date('Y') }} Your Company. All rights reserved.
            </p>
        </div>
    </div>

</body>
</html>
