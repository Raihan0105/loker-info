<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Admin Dashboard') - {{ config('app.name', 'InfoLoker') }}</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

</head>
<body class="font-sans antialiased">
    <div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-100">
        
        <div class="hidden lg:flex lg:flex-shrink-0">
            <div class="flex flex-col w-64">
                @include('layouts.partials.admin-sidebar-content')
            </div>
        </div>

        <div class="flex-1 flex flex-col overflow-hidden">
            <header class="relative z-10 flex-shrink-0 flex h-16 bg-white shadow-sm">
                <button @click.stop="sidebarOpen = true" class="px-4 border-r border-gray-200 text-gray-500 focus:outline-none lg:hidden">
                    <span class="sr-only">Open sidebar</span>
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
                    </svg>
                </button>
                <div class="flex-1 px-4 flex justify-between">
                    <div class="flex-1 flex items-center">
                         <h1 class="text-2xl font-semibold text-gray-800">@yield('title')</h1>
                    </div>
                    <div class="ml-4 flex items-center md:ml-6">
                        <div x-data="{ dropdownOpen: false }" class="ml-3 relative">
                            <div>
                                <button @click="dropdownOpen = !dropdownOpen" type="button" class="max-w-xs bg-white flex items-center text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    <span class="sr-only">Open user menu</span>
                                    <span class="inline-block h-8 w-8 rounded-full overflow-hidden bg-gray-100">
                                        <svg class="h-full w-full text-gray-300" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M24 20.993V24H0v-2.997A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                                        </svg>
                                    </span>
                                </button>
                            </div>
                            <div x-show="dropdownOpen" @click.away="dropdownOpen = false" x-transition class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" style="display: none;">
                                <div class="px-4 py-2 text-sm text-gray-700 border-b">
                                    <p class="font-semibold">{{ Auth::guard('admin')->user()->name }}</p>
                                    <p class="text-xs text-gray-500 truncate">{{ Auth::guard('admin')->user()->email }}</p>
                                </div>
                                <form method="POST" action="{{ route('admin.logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full text-left block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Logout</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <main class="flex-1 relative overflow-y-auto focus:outline-none bg-gray-50"> {{-- Latar Belakang Konten Diubah --}}
                <div class="py-6 sm:py-8">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
                        @yield('content')
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
</html>