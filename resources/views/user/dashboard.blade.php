@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
{{-- Inisialisasi Alpine.js untuk state modal --}}
<div class="space-y-8" x-data="{ detailModalOpen: false, selectedLoker: {} }">
    
    <div class="p-6 bg-white rounded-lg shadow-md">
        <h1 class="text-2xl font-bold text-gray-800">
            Selamat Datang Kembali, <span class="text-indigo-600">{{ Auth::user()->name }}</span>!
        </h1>
        <p class="mt-1 text-gray-600">Berikut adalah daftar lowongan pekerjaan yang tersedia untukmu.</p>
    </div>

    <div class="bg-white p-4 rounded-lg shadow-md">
        <form action="{{ route('home') }}" method="GET">
            <div class="flex items-center">
                <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Cari berdasarkan judul atau perusahaan..."
                       class="w-full px-4 py-2 border border-gray-300 rounded-l-md focus:ring-indigo-500 focus:border-indigo-500">
                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white font-semibold rounded-r-md hover:bg-indigo-700">
                    Cari
                </button>
            </div>
        </form>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse ($lokers as $loker)
            <div class="bg-white rounded-lg shadow-lg overflow-hidden flex flex-col transform hover:-translate-y-2 transition-transform duration-300">
                <img class="h-48 w-full object-cover" src="{{ $loker->gambar_url ?: 'https://placehold.co/600x400/e2e8f0/e2e8f0?text=Loker' }}" alt="Gambar {{ $loker->judul }}">
                
                <div class="p-6 flex flex-col flex-grow">
                    <p class="text-sm text-indigo-700 font-semibold">{{ $loker->perusahaan }}</p>
                    <h3 class="mt-1 text-xl font-bold text-gray-900 truncate">{{ $loker->judul }}</h3>
                    
                    <p class="mt-2 text-gray-600 text-sm flex-grow line-clamp-4">{{ $loker->deskripsi }}</p>
                    
                    <div class="mt-6 pt-4 border-t border-gray-200">
                        @if($loker->tgl_tutup)
                        <p class="text-xs text-gray-500 mb-4">
                            Batas Pendaftaran: <span class="font-medium text-red-600">{{ $loker->tgl_tutup->format('d M Y') }}</span>
                        </p>
                        @endif
                        
                        <button @click="detailModalOpen = true; selectedLoker = JSON.parse(atob('{{ base64_encode($loker->toJson()) }}'))" class="block w-full text-center bg-indigo-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-indigo-700 transition-colors">
                            Lihat Detail
                        </button>
                    </div>
                </div>
            </div>
        @empty
            <div class="md:col-span-2 lg:col-span-3 text-center py-16 bg-white rounded-lg shadow-md">
                 <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path vector-effect="non-scaling-stroke" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" /></svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">Hasil tidak ditemukan</h3>
                <p class="mt-1 text-sm text-gray-500">
                    @if($search ?? '')
                        Tidak ada lowongan yang cocok dengan pencarian "{{ $search }}".
                    @else
                        Belum ada lowongan pekerjaan yang tersedia saat ini.
                    @endif
                </p>
            </div>
        @endforelse
    </div>
    
    <div class="mt-8">
        {{ $lokers->appends(['search' => $search ?? ''])->links() }}
    </div>

    {{-- MODAL DETAIL LOKER --}}
    <div x-show="detailModalOpen" class="fixed z-50 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true" style="display: none;">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div x-show="detailModalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" @click="detailModalOpen = false" aria-hidden="true"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div x-show="detailModalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
                 class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full">
                <div class="bg-white">
                    <img class="h-64 w-full object-cover" :src="selectedLoker.gambar_url || 'https://placehold.co/800x400/e2e8f0/e2e8f0?text=Loker'" :alt="'Gambar ' + selectedLoker.judul">
                    <div class="p-6 sm:p-8">
                        <div class="sm:flex sm:items-start">
                            <div class="w-full">
                                <p class="text-base font-semibold text-indigo-600" x-text="selectedLoker.perusahaan"></p>
                                <h3 class="mt-1 text-3xl leading-8 font-extrabold text-gray-900" id="modal-title" x-text="selectedLoker.judul"></h3>
                                <div class="mt-4 flex items-center text-sm text-gray-500" x-show="selectedLoker.tgl_tutup">
                                    <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                    <span>Batas Pendaftaran:</span>
                                    <strong class="ml-1" x-text="new Date(selectedLoker.tgl_tutup).toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' })"></strong>
                                </div>
                            </div>
                        </div>
                        <div class="mt-6">
                            <h4 class="text-lg font-semibold text-gray-800">Deskripsi Pekerjaan</h4>
                            <p class="mt-2 text-base text-gray-600 whitespace-pre-wrap" x-text="selectedLoker.deskripsi"></p>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button" @click="detailModalOpen = false" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 sm:ml-3 sm:w-auto sm:text-sm">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection