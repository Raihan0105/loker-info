@extends('layouts.admin')

@section('title', 'Arsip Loker Terhapus')

@section('content')
    @if (session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg shadow-md" role="alert">
            <p class="font-bold">{{ session('success') }}</p>
        </div>
    @endif

    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="p-4 sm:p-6 border-b border-gray-200">
             <h3 class="text-xl font-semibold text-gray-700">Loker yang Telah Dihapus</h3>
             <p class="mt-1 text-sm text-gray-500">Anda dapat memulihkan item dari sini atau menghapusnya secara permanen.</p>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        {{-- GAMBAR --}}
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Gambar</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Dihapus</th>
                        <th scope="col" class="relative px-6 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($lokers as $loker)
                        <tr class="hover:bg-gray-50">
                             {{-- GAMBAR --}}
                             <td class="px-6 py-4 whitespace-nowrap">
                                <img class="h-10 w-10 rounded-md object-cover" src="{{ $loker->gambar_url ?: 'https://placehold.co/400x400/e2e8f0/e2e8f0?text=.' }}" alt="Gambar">
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $loker->judul }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $loker->deleted_at->format('d M Y') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <form action="{{ route('admin.lokers.restore', $loker->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    <button type="submit" class="text-green-600 hover:text-green-900">Restore</button>
                                </form>
                                <form action="{{ route('admin.lokers.forceDelete', $loker->id) }}" method="POST" class="inline-block ml-4" onsubmit="return confirm('Anda yakin ingin menghapus data ini secara permanen?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900">Hapus Permanen</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center text-gray-500">Arsip kosong.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection