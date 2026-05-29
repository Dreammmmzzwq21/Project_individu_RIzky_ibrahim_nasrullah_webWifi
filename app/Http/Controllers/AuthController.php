<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'login'    => 'required',
            'password' => 'required',
        ]);

        $loginField = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $credentials = [
            $loginField => $request->login,
            'password'  => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }
            return redirect()->route('pelanggan.index');
        }

        return back()->withErrors(['login' => 'Email/username atau password salah.']);
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nama'     => 'required|string|max:255',
            'email'    => 'required|email|unique:tb_user',
            'username' => 'required|unique:tb_user',
            'password' => 'required|min:6|confirmed',
            'hp'       => 'nullable|string',
            'alamat'   => 'nullable|string',
        ]);

        User::create([
            'nama'     => $request->nama,
            'email'    => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'hp'       => $request->hp,
            'alamat'   => $request->alamat,
            'role'     => 'pelanggan',
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}