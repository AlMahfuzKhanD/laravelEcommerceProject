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
        try {
            // input validation 
            $credentials = $request->validate([
                'email' => ['required','email'],
                'password' => ['required']
            ]);

            $email = $request->email;
            $password = $request->password;

            if(Auth::attempt(['email' => $email, 'password' => $password])){
                $request->session()->regenerate();

                $notification = array(
                    'message' => 'Login Successful!',
                    'alert-type' => 'Success'
                );

                return redirect()->intended('/dashboard')->with($notification);
            }else{
                $notification = array(
                    'message' => 'Incorrect Credentials ',
                    'alert-type' => 'error'
                );
                return redirect()->route('login')->with($notification);
            }


        } catch (\Exception $e) {
            dd($e->getMessage());
                $message = $e->getMessage();
                $notification = array(
                    'message' => $message,
                    'alert-type' => 'error'
                );
            return redirect()->back()->with($notification);
        }
    }

    public function register(Request $request) {
        try {
            // input validation 
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


        } catch (\Exception $e) {
                $message = $e->getMessage();
                $notification = array(
                    'message' => $message,
                    'alert-type' => 'error'
                );
            return redirect()->back()->with($notification);
        }
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
