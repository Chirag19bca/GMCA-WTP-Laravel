<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\AutoLoginController;
use App\Http\Controllers\StudentFormController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ChangePasswordController;

/*
|--------------------------------------------------------------------------
| Public Pages
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('home');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/services', function () {
    return view('services');
});

Route::get('/contact', function () {
    return view('contact');
});



/*
|--------------------------------------------------------------------------
| Authentication
|--------------------------------------------------------------------------
*/

// Login
Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');

// Register
Route::get('/register', [RegisterController::class, 'show'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.post');

// Auto Login
Route::get('/auto-login/{user}', [AutoLoginController::class, 'login'])
    ->name('auto.login');
// Logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Forgot password 
Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
});

Route::post('/forgot-password', [ForgotPasswordController::class, 'handle']);

// Change Password
Route::get('/change-password', [ChangePasswordController::class, 'show'])
    ->middleware('auth');

Route::post('/change-password', [ChangePasswordController::class, 'update'])
    ->middleware('auth');


/*
|--------------------------------------------------------------------------
| Protected Pages
|--------------------------------------------------------------------------
*/

Route::get('/profile', [ProfileController::class, 'show'])
    ->middleware('auth');
Route::get('/calc', function () {
    return view('calc');
})->middleware('auth');
Route::get('/studentform', [StudentFormController::class, 'show'])
    ->middleware('auth');

Route::post('/studentform', [StudentFormController::class, 'store'])
    ->middleware('auth');


Route::fallback(function () {
    return redirect('/');
});
