<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AuthenticatableModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:tb_users,email',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password',
            'ttl' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required',
        ]);

        if ($request->password !== $request->password_confirmation) {
            return back()->withErrors([
                'password_confirmation2' => ['The provided password does not match our records.']
            ]);
        }

        $userId = Str::uuid()->toString();

        $user = AuthenticatableModel::create([
            'id_user' => $userId,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'name' => $request->name,
            'ttl' => $request->ttl,
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp,
            'remember_token' => Str::random(60),
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil. Silakan login.');
    }
}