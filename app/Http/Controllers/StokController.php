<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stok;

class StokController extends Controller
{
    public function index()
    {
        $stokList = Stok::all(); // ambil semua data stok dari tabel
        return view('stok.index', compact('stokList')); // kirim ke view
    }
}
