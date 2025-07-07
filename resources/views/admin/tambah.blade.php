@extends('layouts.admin')

@section('title', 'Tambah Info Loker') {{-- Judul ini akan muncul di header --}}

@section('content')
<div class="bg-white p-8 rounded-lg shadow-lg">
    {{-- Menampilkan Error Validasi --}}
    @if ($errors->any())
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
            <p class="font-bold">Terjadi Kesalahan:</p>
            <ul>
            @foreach ($errors->all() as $error)
                <li>- {{ $error }}</li>
            @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.store') }}" method="POST">
        @csrf
        <div class="space-y-6">
            <div>
                <label for="judul" class="block text-sm font-medium text-gray-700">Judul Loker</label>
                <input type="text" name="judul" id="judul" value="{{ old('judul') }}" required
                       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                       placeholder="Contoh: Web Developer (Full-Stack)">
            </div>
            <div>
                <label for="perusahaan" class="block text-sm font-medium text-gray-700">Nama Perusahaan</label>
                <input type="text" name="perusahaan" id="perusahaan" value="{{ old('perusahaan') }}" required
                       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                       placeholder="Contoh: PT Teknologi Maju">
            </div>
            <div>
                <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi Pekerjaan</label>
                <textarea name="deskripsi" id="deskripsi" rows="5" required
                          class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                          placeholder="Jelaskan tentang pekerjaan, kualifikasi, dan cara melamar.">{{ old('deskripsi') }}</textarea>
            </div>
                        {{-- TAMBAHKAN INPUT BARU DI SINI --}}
            <div>
                <label for="tgl_tutup" class="block text-sm font-medium text-gray-700">Tanggal Pendaftaran Ditutup</label>
                <input type="date" name="tgl_tutup" id="tgl_tutup" value="{{ old('tgl_tutup') }}"
                       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
            <div>
                <label for="gambar_url" class="block text-sm font-medium text-gray-700">Link Gambar (Opsional)</label>
                <input type="url" name="gambar_url" id="gambar_url" value="{{ old('gambar_url') }}"
                       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                       placeholder="https://contoh.com/gambar.jpg">
            </div>
            <div class="flex justify-end space-x-4 pt-4">
                <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                    Batal
                </a>
                <button type="submit" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700">
                    Simpan Loker
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
