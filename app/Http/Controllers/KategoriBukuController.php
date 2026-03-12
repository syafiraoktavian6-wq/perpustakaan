<?php

namespace App\Http\Controllers;

use App\Models\KategoriBuku;
use Illuminate\Http\Request;

class KategoriBukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategori = KategoriBuku::all();

        return view('admin.kategori.index', compact('kategori'));
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
    public function store(Request $request)
    {
        $request->validate([
            'NamaKategori' => 'required'
        ]);

        KategoriBuku::create($request->all());

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambah!');
    }

    /**
     * Display the specified resource.
     */
    public function show(KategoriBuku $kategoriBuku)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KategoriBuku $kategoriBuku)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, KategoriBuku $kategoriBuku)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $kategori = KategoriBuku::findOrFail($id);
        $kategori->delete();
            return redirect()->back()->with('success', 'Kategori berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus! Kategori mungkin masih digunakan oleh data buku.');
        }
    }
}
