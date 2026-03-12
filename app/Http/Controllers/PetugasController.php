<?php

namespace App\Http\Controllers;

use App\Models\User; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; 

class PetugasController extends Controller
{
    public function index()
    {
        $petugas = User::whereIn('role', ['petugas', 'administrator'])->get();
        return view('admin.petugas.index', compact('petugas'));
    }

    public function create()
    {
        return view('admin.petugas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'Username' => 'required|unique:users',
            'Password' => 'required|min:4',
            'Email' => 'required|email|unique:users',
            'NamaLengkap' => 'required',
            'role' => 'required'
        ]);

        User::create([
            'Username' => $request->Username,
            'Password' => Hash::make($request->Password), 
            'Email' => $request->Email,
            'NamaLengkap' => $request->NamaLengkap,
            'Alamat' => $request->Alamat ?? '-',
            'role' => $request->role,
        ]);

        return redirect()->route('petugas.index')->with('success', 'Petugas berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->route('petugas.index')->with('success', 'Data petugas telah dihapus.');
    }
    public function edit($id)
{
    $petugas = User::findOrFail($id);
    return view('admin.petugas.edit', compact('petugas'));
}

public function update(Request $request, $id)
{
    $user = User::findOrFail($id);
    
    $data = [
        'Username' => $request->Username,
        'Email' => $request->Email,
        'NamaLengkap' => $request->NamaLengkap,
        'role' => $request->role,
    ];

    if ($request->filled('Password')) {
        $data['Password'] = Hash::make($request->Password);
    }

    $user->update($data);

    return redirect()->route('petugas.index')->with('success', 'Data petugas berhasil diperbarui!');
}
}