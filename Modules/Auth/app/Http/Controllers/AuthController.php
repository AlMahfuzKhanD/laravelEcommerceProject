<?php

namespace Modules\Auth\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function showLoginForm() {
        return view('auth::login');
    }

    public function showRegisterForm() {
        return view('auth::register');
    }

    public function login(Request $request) {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'email' => 'Invalid credentials.',
        ]);
    }

    public function register(Request $request) {
        $request->validate([
            'name' => ['required'],
            'user_name' => ['required'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'confirmed', 'min:6'],
        ]);
        $user = User::create([
            'name' => $request->name,
            'username' => $request->user_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        Auth::login($user);
        return redirect('/dashboard');
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
