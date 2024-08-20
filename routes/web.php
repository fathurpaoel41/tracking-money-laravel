<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\CategoryController;

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

    Route::get('/logout', [AuthenticationController::class, 'logout'])->name('logout');

    Route::controller(WalletController::class)->group(function () {
        Route::get('/wallet', 'viewWallet')->name('wallet');
        Route::post('/addWallet', 'addWallet')->name("addWallet");
        Route::get('/detailWallet/{id_dompet}', 'detailWallet')->name("detailWallet");
    });

    Route::controller(CategoryController::class)->group(function () {
        Route::get("/categoryInput", 'viewCategory')->name("categoryHome");
        Route::post('/addCategoryInput', 'createCategoryInput')->name("addCategoryInput");
        Route::get("/categories/{page?}",'getCategories')->name("getCategories");
    });

    Route::get('/blank', function () {
        return view('content/blank');
    });
});


Route::middleware('guest')->group(function () {
    Route::get('/login',[AuthenticationController::class, 'viewLogin']);
    Route::post('/login',[AuthenticationController::class, 'authLogin'])->name("login");
});

