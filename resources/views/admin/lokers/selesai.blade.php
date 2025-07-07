@extends('layouts.admin')

@section('title', 'Info Loker Selesai')

@section('content')
    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="p-4 sm:p-6 border-b border-gray-200">
             <h3 class="text-xl font-semibold text-gray-700">Arsip Lowongan Pekerjaan yang Telah Selesai</h3>
             <p class="mt-1 text-sm text-gray-500">Ini adalah daftar loker yang tanggal tutupnya sudah lewat atau sudah ditandai selesai.</p>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        {{-- GAMBAR --}}
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Gambar</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Tutup</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($lokers as $loker)
                        <tr class="hover:bg-gray-50 opacity-75">
                            {{-- GAMBAR --}}
                             <td class="px-6 py-4 whitespace-nowrap">
                                <img class="h-10 w-10 rounded-md object-cover" src="{{ $loker->gambar_url ?: 'https://placehold.co/400x400/e2e8f0/e2e8f0?text=.' }}" alt="Gambar">
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $loker->judul }}</div>
                                <div class="text-sm text-gray-500">{{ $loker->perusahaan }}</div>
                            </td>
                             <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-red-600">
                                {{ $loker->tgl_tutup ? $loker->tgl_tutup->format('d M Y') : 'N/A' }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-6 py-12 text-center text-gray-500">
                                Tidak ada data loker yang telah selesai.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection