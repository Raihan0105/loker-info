@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    {{-- Notifikasi Sukses --}}
    @if (session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg shadow-md" role="alert">
            <p class="font-bold">{{ session('success') }}</p>
        </div>
    @endif

    {{-- KARTU STATISTIK --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
        <div class="bg-white p-6 rounded-lg shadow-md flex items-center">
            <div class="bg-indigo-500 p-3 rounded-full mr-4">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500">Total Lowongan</p>
                <p class="text-2xl font-bold text-gray-800">{{ $totalLokers }}</p>
            </div>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-md flex items-center">
            <div class="bg-green-500 p-3 rounded-full mr-4">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500">Baru Ditambahkan (Hari Ini)</p>
                <p class="text-2xl font-bold text-gray-800">{{ $newLokersToday }}</p>
            </div>
        </div>
    </div>

    {{-- Tabel Loker --}}
    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="p-4 sm:p-6 border-b border-gray-200 flex justify-between items-center">
             <h3 class="text-xl font-semibold text-gray-700">Daftar Lowongan Tersedia</h3>
             <a href="{{ route('admin.tambah') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                + Tambah Loker Baru
            </a>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Tutup</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th> {{-- KOLOM BARU --}}
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($lokersTersedia as $loker)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $loker->judul }}</div>
                                <div class="text-sm text-gray-500">{{ $loker->perusahaan }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-500">
                               {{ $loker->tgl_tutup ? $loker->tgl_tutup->format('d M Y') : '-' }}
                            </td>
                            {{-- KONTEN KOLOM STATUS BARU --}}
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($loker->status == 'selesai')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">Selesai</span>
                                @else
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Tersedia</span>
                                @endif
                            </td>
                            {{-- KONTEN AKSI YANG DIMODIFIKASI --}}
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                @if($loker->status == 'selesai')
                                    <span class="text-gray-400 cursor-not-allowed">Edit</span>
                                    <span class="text-gray-400 cursor-not-allowed ml-4">Hapus</span>
                                @else
                                    <button @click="editModalOpen = true; selectedLoker = {{ $loker }}" class="text-indigo-600 hover:text-indigo-900">Edit</button>
                                    <button @click="deleteModalOpen = true; selectedLoker = {{ $loker }}" class="text-red-600 hover:text-red-900 ml-4">Hapus</button>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center text-gray-500">
                                Belum ada data loker yang ditambahkan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection