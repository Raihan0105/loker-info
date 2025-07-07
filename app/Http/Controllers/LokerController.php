<?php

namespace App\Http\Controllers;

use App\Models\Loker;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LokerController extends Controller
{
    // ... method index(), create(), store() Anda yang sudah ada ...
    public function index()
    {
        $lokersTersedia = Loker::where(function ($query) {
            $query->where('tgl_tutup', '>=', Carbon::today())
                  ->orWhereNull('tgl_tutup');
        })->latest()->get();
        $totalLokers = Loker::count();
        $newLokersToday = Loker::whereDate('created_at', Carbon::today())->count();
        return view('admin.dashboard', compact(
            'lokersTersedia', 
            'totalLokers', 
            'newLokersToday'
        ));
    }
    public function create()
    {
        return view('admin.tambah');
    }
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string',
            'perusahaan' => 'required|string',
            'deskripsi' => 'required|string',
            'gambar_url' => 'nullable|url',
            'tgl_tutup' => 'nullable|date',
        ]);
        Loker::create($request->all());
        return redirect()->route('admin.dashboard')->with('success', 'Loker berhasil ditambahkan!');
    }


    // --- TAMBAHKAN METHOD BARU DI SINI ---

    /**
     * Menampilkan daftar loker yang masih tersedia.
     */
    // app/Http/Controllers/LokerController.php

public function tersedia()
{
    $lokers = Loker::where('status', 'tersedia') // Hanya ambil yang statusnya 'tersedia'
                   ->where(function ($query) {
                       $query->where('tgl_tutup', '>=', Carbon::today())
                             ->orWhereNull('tgl_tutup');
                   })
                   ->latest()
                   ->get();
    
    return view('admin.lokers.tersedia', compact('lokers'));
}
    /**
     * Menampilkan daftar loker yang sudah selesai/kedaluwarsa.
     */
public function selesai()
{
    // Ganti query agar mengambil berdasarkan status 'selesai'
    // atau yang tanggalnya sudah lewat.
    $lokers = Loker::where('status', 'selesai')
                   ->orWhere(function($query) {
                       $query->whereNotNull('tgl_tutup')
                             ->where('tgl_tutup', '<', Carbon::today());
                   })
                   ->latest()
                   ->get();

    return view('admin.lokers.selesai', compact('lokers'));
}
    public function destroy(Loker $loker)
    {
        $loker->delete(); // Ini akan melakukan soft delete
        return redirect()->back()->with('success', 'Loker berhasil dipindahkan ke arsip.');
    }

    public function trash()
    {
        $lokers = Loker::onlyTrashed()->latest()->get();
        return view('admin.lokers.trash', compact('lokers'));
    }

    public function restore($id)
    {
        $loker = Loker::onlyTrashed()->findOrFail($id);
        $loker->restore();
        return redirect()->route('admin.lokers.trash')->with('success', 'Loker berhasil dipulihkan.');
    }

    public function forceDelete($id)
    {
        $loker = Loker::onlyTrashed()->findOrFail($id);
        $loker->forceDelete();
        return redirect()->route('admin.lokers.trash')->with('success', 'Loker berhasil dihapus secara permanen.');
    }

    public function update(Request $request, Loker $loker)
    {
        $request->validate([
            'judul' => 'required|string',
            'perusahaan' => 'required|string',
            'deskripsi' => 'required|string',
            'gambar_url' => 'nullable|url',
            'tgl_tutup' => 'nullable|date',
        ]);

        $loker->update($request->all());

        return redirect()->back()->with('success', 'Loker berhasil diperbarui.');
    }

 public function markAsSelesai(Loker $loker)
{
    // Cara yang lebih eksplisit untuk update status
    $loker->status = 'selesai';
    $loker->save(); // Simpan perubahan ke database

    return redirect()->back()->with('success', 'Loker telah ditandai sebagai selesai.');
}
}