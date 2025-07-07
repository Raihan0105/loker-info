<div class="h-16 flex-shrink-0 flex items-center justify-center px-4 bg-indigo-700 shadow-lg">
    <a href="{{ route('admin.dashboard') }}" class="text-white font-bold text-xl tracking-wider">
        ADMIN PANEL
    </a>
</div>

<div class="flex-1 flex flex-col overflow-y-auto bg-gray-800">
    <nav class="mt-5 flex-1 px-2 space-y-2">
        <p class="px-2 py-2 text-xs font-semibold text-gray-400 uppercase tracking-wider">Menu Utama</p>
        
        <a href="{{ route('admin.dashboard') }}"
           class="text-gray-300 hover:bg-gray-700 hover:text-white group flex items-center px-2 py-2 text-sm font-medium rounded-md {{ request()->routeIs('admin.dashboard') ? 'bg-gray-900 text-white' : '' }}">
            <svg class="mr-3 flex-shrink-0 h-6 w-6 text-gray-400 group-hover:text-gray-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
            Dashboard
        </a>
        
        <a href="{{ route('admin.tambah') }}"
           class="text-gray-300 hover:bg-gray-700 hover:text-white group flex items-center px-2 py-2 text-sm font-medium rounded-md {{ request()->routeIs('admin.tambah') ? 'bg-gray-900 text-white' : '' }}">
            <svg class="mr-3 flex-shrink-0 h-6 w-6 text-gray-400 group-hover:text-gray-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            Tambah Loker
        </a>

        <p class="px-2 pt-4 pb-2 text-xs font-semibold text-gray-400 uppercase tracking-wider">Laporan</p>

        <a href="{{ route('admin.lokers.tersedia') }}"
           class="text-gray-300 hover:bg-gray-700 hover:text-white group flex items-center px-2 py-2 text-sm font-medium rounded-md">
            <svg class="mr-3 flex-shrink-0 h-6 w-6 text-green-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            Info Loker Tersedia
        </a>

        <a href="{{ route('admin.lokers.selesai') }}"
           class="text-gray-300 hover:bg-gray-700 hover:text-white group flex items-center px-2 py-2 text-sm font-medium rounded-md">
            <svg class="mr-3 flex-shrink-0 h-6 w-6 text-red-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            Info Loker Selesai
        </a>
        <a href="{{ route('admin.lokers.trash') }}"
        class="text-gray-300 hover:bg-gray-700 hover:text-white group flex items-center px-2 py-2 text-sm font-medium rounded-md {{ request()->routeIs('admin.lokers.trash') ? 'bg-gray-900 text-white' : '' }}">
            <svg class="mr-3 flex-shrink-0 h-6 w-6 text-gray-400"  fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
            Arsip Terhapus
        </a>
        
    </nav>
</div>