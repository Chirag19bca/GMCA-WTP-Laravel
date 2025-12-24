<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
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

Route::get('/calc', function () {
    return view('calc');
});

Route::get('/studentform', function () {
    return view('studentform');
});

/* Auth pages */
Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/register', function () {
    return view('auth.register');
});

Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
});

Route::get('/reset-password', function () {
    return view('auth.reset-password');
});

/* Profile */
Route::get('/profile', function () {
    return view('profile');
});
