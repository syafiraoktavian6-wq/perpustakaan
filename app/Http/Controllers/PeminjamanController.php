<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\KoleksiPribadi;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $buku = Buku::all();

        $pinjaman = Peminjaman::with('buku')
            ->where('UserID', auth()->user()->UserID)
            ->orderBy('TanggalPeminjaman', 'desc')
            ->get();

        return view('peminjam.index', compact('buku', 'pinjaman'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        \App\Models\Peminjaman::create([
            'UserID' => auth()->user()->UserID,
            'BukuID' => $id,
            'TanggalPeminjaman' => now(),
            'StatusPeminjaman' => 'Dipinjam',
        ]);

        return redirect()->route('peminjam.pinjaman')->with('success', 'Buku berhasil dipinjam!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Peminjaman $peminjaman)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Peminjaman $peminjaman)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Peminjaman $peminjaman)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Peminjaman $peminjaman)
    {
        //
    }
    public function kembalikan($id)
    {
        $peminjaman = Peminjaman::find($id);

        if ($peminjaman) {
            $peminjaman->update([
                'TanggalPengembalian' => now(),
                'StatusPeminjaman' => 'Sudah Dikembalikan'
            ]);

            return redirect()->back()->with('success', 'Buku telah berhasil dikembalikan!');
        }

        return redirect()->back()->with('error', 'Data peminjaman tidak ditemukan.');
    }
    public function pinjamanSaya()
    {
        $pinjaman = Peminjaman::with('buku')
            ->where('UserID', Auth::user()->UserID)
            ->get();

        return view('peminjam.pinjaman', compact('pinjaman'));
    }
    public function tambahKoleksi(Request $request)
    {
        $exists = KoleksiPribadi::where('UserID', Auth::user()->UserID)
                                ->where('BukuID', $request->BukuID)
                                ->exists();

        if ($exists) {
            return redirect()->back()->with('error', 'Buku sudah ada di koleksi Anda.');
        }

        KoleksiPribadi::create([
            'UserID' => Auth::user()->UserID,
            'BukuID' => $request->BukuID,
        ]);

        return redirect()->back()->with('success', 'Berhasil simpan ke koleksi!');
    }

    public function koleksiSaya()
    {
        $koleksi = KoleksiPribadi::with('buku')
                    ->where('UserID', Auth::user()->UserID)
                    ->get();
                    
        return view('peminjam.koleksi', compact('koleksi'));
    }

    public function hapusKoleksi($id)
{
    $koleksi = \App\Models\KoleksiPribadi::where('KoleksiID', $id)
                ->where('UserID', auth()->id()) // Pastikan hanya bisa hapus punya sendiri
                ->firstOrFail();

    $koleksi->delete();

    return redirect()->back()->with('success', 'Buku berhasil dihapus dari koleksi.');
}
}
