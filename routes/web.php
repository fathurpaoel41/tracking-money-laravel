<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AuthenticationController;

Route::get('/', function () {
    return view('content/dashboard');
});

Route::get('/register',[RegisterController::class, 'showRegistrationForm']);
Route::post('/register', [RegisterController::class, 'register'])->name('register');
Route::get('/login',[AuthenticationController::class, 'viewLogin'])->name('login');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('content/dashboard');
    })->name("dashboard");
    Route::get('/logout',[AuthenticationController::class, 'logout'])->name('logout');
    
});

Route::middleware('guest')->group(function () {
    Route::get('/login',[AuthenticationController::class, 'viewLogin']);
    Route::post('/login',[AuthenticationController::class, 'authLogin'])->name("login");
});

