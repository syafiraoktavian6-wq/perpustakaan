<?php

namespace App\Http\Controllers;

use App\Models\UlasanBuku;
use Illuminate\Http\Request;

class UlasanBukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ulasan = \App\Models\UlasanBuku::with(['user', 'buku'])->latest()->get();
        return view('ulasan.index', compact('ulasan'));
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
            'BukuID' => 'required',
            'Ulasan' => 'required',
            'Rating' => 'required|integer|min:1|max:5',
        ]);

        \App\Models\UlasanBuku::create([
            'UserID' => auth()->user()->UserID,
            'BukuID' => $request->BukuID,
            'Ulasan' => $request->Ulasan,
            'Rating' => $request->Rating,
        ]);

        return redirect()->back()->with('success', 'Ulasan berhasil dikirim!');
    }

    /**
     * Display the specified resource.
     */
    public function show(UlasanBuku $ulasanBuku)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UlasanBuku $ulasanBuku)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UlasanBuku $ulasanBuku)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UlasanBuku $ulasanBuku)
    {
        //
    }
}
