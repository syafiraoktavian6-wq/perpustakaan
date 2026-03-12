<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }
    public function showRegister()
    {
        return view('auth.register');
    }
    public function register(Request $request)
    {
        $request->validate([
            'Username' => 'required|unique:users,Username',
            'Password' => 'required|min:4',
            'Email' => 'required|email|unique:users,Email',
            'NamaLengkap' => 'required',
            'Alamat' => 'required',
        ]);

        \App\Models\User::create([
            'Username' => $request->Username,
            'Password' => $request->Password,
            'Email' => $request->Email,
            'NamaLengkap' => $request->NamaLengkap,
            'Alamat' => $request->Alamat,
            'role' => 'peminjam',
        ]);

        return redirect('/login')->with('success', 'Pendaftaran berhasil! Silakan login.');
    }
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
{
    $credentials = $request->validate([
        'Username' => 'required',
        'Password' => 'required',
    ]);

    if (Auth::attempt(['Username' => $request->Username, 'password' => $request->Password])) {
        $request->session()->regenerate();
        return redirect()->intended('/dashboard');
    }

    return back()->withErrors([
        'loginError' => 'Username atau Password salah!',
    ]);
}

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}