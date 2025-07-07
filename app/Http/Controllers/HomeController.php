<?php

namespace App\Http\Controllers;

use App\Models\Loker;
use Illuminate\Http\Request; // <-- Tambahkan ini

class HomeController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

// app/Http/Controllers/HomeController.php

public function index(Request $request)
{
    $query = Loker::where('status', 'tersedia');

    if ($request->has('search') && $request->search != '') {
        $query->where(function($q) use ($request) {
            $q->where('judul', 'like', '%' . $request->search . '%')
              ->orWhere('perusahaan', 'like', '%' . $request->search . '%');
        });
    }

    $lokers = $query->latest()->paginate(9);

    // Hentikan dan tampilkan isi variabel $lokers

    return view('user.dashboard', [
        'lokers' => $lokers,
        'search' => $request->search ?? ''
    ]);
}

}