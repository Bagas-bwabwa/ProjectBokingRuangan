<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;


// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('welcome');
})->name('home');


Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::get('/login', [LoginController::class, 'showLoginForm'])
    ->name('login');

// proses login
Route::post('/login', [LoginController::class, 'login']);

// logout
Route::post('/logout', [LoginController::class, 'logout'])
    ->name('logout');

    Route::get('/home', [HomeController::class, 'index'])->name('home');



Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
