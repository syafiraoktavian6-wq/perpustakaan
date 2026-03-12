<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Peminjaman;
use Illuminate\Http\Request;


class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $buku = Buku::all();
        return view('buku.index', compact('buku'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategori = \App\Models\KategoriBuku::all();
        return view('buku.create', compact('kategori'));
        return view('admin.buku.create', compact('kategori'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'Judul' => 'required',
            'Penulis' => 'required',
            'Penerbit' => 'required',
            'TahunTerbit' => 'required|numeric',
        ]);

        Buku::create($request->all());

        return redirect()->route('buku.index')->with('success', 'Buku berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Buku $buku)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $buku = \App\Models\Buku::where('BukuID', $id)->firstOrFail();
        $kategori = \App\Models\KategoriBuku::all();
        return view('buku.edit', compact('buku', 'kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'Judul' => 'required',
            'Penulis' => 'required',
            'Penerbit' => 'required',
            'TahunTerbit' => 'required|numeric',
        ]);

        $buku = Buku::findOrFail($id);
        $buku->update($request->all());

        return redirect()->route('buku.index')->with('success', 'Buku berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $buku = Buku::findOrFail($id);
        $buku->delete();

        return redirect()->route('buku.index')->with('success', 'Buku berhasil dihapus!');
    }
    public function laporan()
    {

        $laporan = Peminjaman::with(['user', 'buku'])->get();

        return view('laporan.index', compact('laporan'));
    }
    public function cetak_pdf()
{
    $buku = \App\Models\Buku::all();
}
}
