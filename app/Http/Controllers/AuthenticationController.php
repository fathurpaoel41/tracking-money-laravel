<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    public function viewLogin(){
        return view('auth.login');
    }

    public function authLogin(Request $request){

        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Attempt to log the user in
        if (Auth::attempt($request->only('email', 'password'))) {
            // If successful, redirect to the intended page
            return redirect()->intended('/dashboard');
        }

        // If unsuccessful, redirect back to the login form
        return redirect()->back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
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
