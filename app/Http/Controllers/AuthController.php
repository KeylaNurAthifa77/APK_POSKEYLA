<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    /**
     * Menampilkan halaman login.
     */
    public function index()
    {
        return view('login');
    }

    /**
     * Memproses autentikasi pengguna.
     */
    public function auth(LoginRequest $request)
    {
        // Mengambil data terverifikasi dari LoginRequest
        $credentials = $request->validated();

        // Mencoba login dengan kredensial yang diberikan
        if (Auth::attempt($credentials)) {
            // Regenerasi session ID untuk mencegah session fixation attacks
            $request->session()->regenerate();

            // Mengarahkan ke halaman dashboard (atau halaman tujuan sebelum terputus)
            return redirect()->intended(route('dashboard'))->with('success', 'Selamat Datang, ' . Auth::user()->name);
        }

        // Jika login gagal, kembalikan ke halaman login dengan membawa error dan input email lama
        return back()->withErrors([
            'email' => 'Email atau password tidak sesuai dengan data kami.',
        ])->onlyInput('email');
    }

    /**
     * Memproses logout pengguna.
     */
    public function logout(Request $request)
    {
        // Mengakhiri sesi autentikasi pengguna
        Auth::logout();

        // Menghapus semua data session pengguna
        $request->session()->invalidate();

        // Meregenerasi token CSRF baru untuk keamanan
        $request->session()->regenerateToken();

        // Redirect ke halaman login setelah logout
        return redirect()->route('login')->with('success', 'Anda telah berhasil keluar dari aplikasi!');
    }
}