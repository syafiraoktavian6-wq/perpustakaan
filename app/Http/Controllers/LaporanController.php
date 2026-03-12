<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;

class LaporanController extends Controller
{
    public function generate()
    {
        $laporan = Peminjaman::with(['user', 'buku'])->get();
        return view('laporan.index', compact('laporan'));
    }
}