@extends('layouts.admin')

@section('title', 'Info Loker Tersedia')

@section('content')
<div x-data="{ 
    editModalOpen: false, 
    deleteModalOpen: false,
    selectedLoker: {} 
}">
    @if (session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg shadow-md" role="alert">
            <p class="font-bold">{{ session('success') }}</p>
        </div>
    @endif
    
    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="p-4 sm:p-6 border-b border-gray-200">
             <h3 class="text-xl font-semibold text-gray-700">Daftar Lowongan Pekerjaan yang Masih Tersedia</h3>
             <p class="mt-1 text-sm text-gray-500">Ini adalah daftar loker yang tanggal tutupnya belum lewat atau tidak memiliki tanggal tutup.</p>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        {{-- GAMBAR --}}
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Gambar</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tgl Tutup</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($lokers as $loker)
                        <tr class="hover:bg-gray-50">
                            {{-- GAMBAR --}}
                            <td class="px-6 py-4 whitespace-nowrap">
                                <img class="h-10 w-10 rounded-md object-cover" src="{{ $loker->gambar_url ?: 'https://placehold.co/400x400/e2e8f0/e2e8f0?text=.' }}" alt="Gambar">
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $loker->judul }}</div>
                                <div class="text-sm text-gray-500">{{ $loker->perusahaan }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-500">
                                {{ $loker->tgl_tutup ? $loker->tgl_tutup->format('d M Y') : '-' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($loker->status == 'selesai')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">Selesai</span>
                                @else
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Tersedia</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                @if($loker->status == 'tersedia' && $loker->tgl_tutup && $loker->tgl_tutup->isToday())
                                <form action="{{ route('admin.lokers.markAsSelesai', $loker) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="text-green-600 hover:text-green-900" title="Tandai Selesai">Selesaikan</button>
                                </form>
                                @endif
                                <button @click="editModalOpen = true; selectedLoker = {{ $loker }}" class="text-indigo-600 hover:text-indigo-900 ml-4">Edit</button>
                                <button @click="deleteModalOpen = true; selectedLoker = {{ $loker }}" class="text-red-600 hover:text-red-900 ml-4">Hapus</button>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="px-6 py-12 text-center text-gray-500">Tidak ada data loker tersedia saat ini.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div x-show="editModalOpen" class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true" style="display: none;">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div x-show="editModalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" @click="editModalOpen = false" aria-hidden="true"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div x-show="editModalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <form :action="`/admin/lokers/${selectedLoker.id}`" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Edit Loker</h3>
                        <div class="mt-4 space-y-4">
                            <div>
                                <label for="judul" class="block text-sm font-medium text-gray-700">Judul</label>
                                <input type="text" x-model="selectedLoker.judul" name="judul" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>
                             <div>
                                <label for="perusahaan" class="block text-sm font-medium text-gray-700">Perusahaan</label>
                                <input type="text" x-model="selectedLoker.perusahaan" name="perusahaan" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>
                            <div>
                                <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                                <textarea x-model="selectedLoker.deskripsi" name="deskripsi" rows="4" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"></textarea>
                            </div>
                            {{-- INPUT GAMBAR --}}
                            <div>
                                <label for="gambar_url" class="block text-sm font-medium text-gray-700">Link Gambar (URL)</label>
                                <input type="url" x-model="selectedLoker.gambar_url" name="gambar_url" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>
                            <div>
                                <label for="tgl_tutup" class="block text-sm font-medium text-gray-700">Tanggal Tutup</label>
                                <input type="date" x-model="selectedLoker.tgl_tutup" name="tgl_tutup" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 sm:ml-3 sm:w-auto sm:text-sm">Simpan</button>
                        <button type="button" @click="editModalOpen = false" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 sm:mt-0 sm:w-auto sm:text-sm">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div x-show="deleteModalOpen" class="fixed z-10 inset-0 overflow-y-auto" style="display: none;">
        {{-- Konten modal delete tidak berubah --}}
        <div class="flex items-center justify-center min-h-screen">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
            <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full">
                <div class="bg-white p-6">
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                            <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">Hapus Loker</h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500">Anda yakin ingin menghapus loker <strong x-text="selectedLoker.judul"></strong>? Data akan dipindahkan ke arsip.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <form :action="`/admin/lokers/${selectedLoker.id}`" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 sm:ml-3 sm:w-auto sm:text-sm">Ya, Hapus</button>
                    </form>
                    <button type="button" @click="deleteModalOpen = false" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 sm:mt-0 sm:w-auto sm:text-sm">Batal</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection