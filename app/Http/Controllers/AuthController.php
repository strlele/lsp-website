<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $key = 'login_attempts:' . $request->ip() . ':' . $request->username;

        if (RateLimiter::tooManyAttempts($key, 5)) {
            $seconds = RateLimiter::availableIn($key);

            return redirect()->back()->withErrors([
                'throttle' => "Terlalu banyak percobaan login. Silakan coba lagi dalam {$seconds} detik.",
            ])->withInput($request->only('username'));
        }

        $credentials = $request->validated();

        if (!Auth::attempt($credentials)) {
            RateLimiter::hit($key, 60);

            return redirect()->back()->withErrors([
                'username' => 'Username atau password salah',
            ])->withInput($request->only('username'));
        }

        RateLimiter::clear($key);

        return redirect()->intended(route('admin.slideshow.index'))->with('success', 'Login berhasil');
    }

    public function showLoginForm()
    {
        $pageData = [
            'title' => 'Login | LSP SMKN 1 Purwosari',
            'description' => 'Login Page LSP SMKN 1 Purwosari',
            'image_url' => asset('assets/img/meta/login.png'),
        ];

        return view('auth.login', [
            'title' => 'Login | LSP SMKN 1 Purwosari',
            'pageData' => $pageData
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
