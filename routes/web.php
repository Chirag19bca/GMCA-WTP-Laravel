<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\AutoLoginController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ChangePasswordController;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentFormController;

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
Route::get('/login', [LoginController::class, 'show'])
    ->name('login');

Route::post('/login', [LoginController::class, 'login'])
    ->name('login.post');

// Register
Route::get('/register', [RegisterController::class, 'show'])
    ->name('register');

Route::post('/register', [RegisterController::class, 'register'])
    ->name('register.post');

// Auto Login
Route::get('/auto-login/{user}', [AutoLoginController::class, 'login'])
    ->name('auto.login');

// Logout (POST – correct & secure)
Route::post('/logout', [LoginController::class, 'logout'])
    ->name('logout');

// Forgot Password
Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
});

Route::post('/forgot-password', [ForgotPasswordController::class, 'handle']);

/*
|--------------------------------------------------------------------------
| Protected Pages (AUTH REQUIRED)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'show']);

    Route::get('/calc', function () {
        return view('calc');
    });

    // Student Form
    Route::get('/studentform', [StudentFormController::class, 'show']);
    Route::post('/studentform', [StudentFormController::class, 'store']);

    // Change Password
    Route::get('/change-password', [ChangePasswordController::class, 'show']);
    Route::post('/change-password', [ChangePasswordController::class, 'update']);
});

/*
|--------------------------------------------------------------------------
| Fallback
|--------------------------------------------------------------------------
*/

Route::fallback(function () {
    return redirect('/');
});
