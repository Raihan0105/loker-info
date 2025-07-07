<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'InfoLoker') - {{ config('app.name', 'InfoLoker') }}</title>

    {{-- Script & Styles --}}
    <script src="https://cdn.tailwindcss.com"></script>
    {{-- Menambahkan 'defer' sangat penting agar script tidak memblokir render halaman --}}
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    {{-- Slot untuk menambahkan style khusus dari halaman anak --}}
    @stack('styles')

</head>
<body class="bg-gray-100 font-sans antialiased">

    {{-- Navigasi Bar --}}
    <nav class="bg-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex-shrink-0">
                    <a href="{{ route('home') }}" class="font-bold text-xl text-indigo-600">InfoLoker</a>
                </div>
                <div class="hidden md:block">
                    <div class="ml-4 flex items-center md:ml-6">
                        @auth
                            <span class="text-gray-700 mr-4">Halo, {{ Auth::user()->name }}</span>
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit" class="text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-md text-sm font-medium">Logout</button>
                            </form>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </nav>

    {{-- Konten Halaman --}}
    <main class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @yield('content')
        </div>
    </main>

</body>
</html>