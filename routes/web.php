<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Middleware\AuthenticateUser;


Route::post('/login', [UserController::class, 'login'])->name('login');
Route::post('/register', [UserController::class, 'createUser']);
Route::get('/login', function () {
    return view('auth.login');
})->name('auth.login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::get('/welcome', function () {
    return view('welcome');
})->middleware(AuthenticateUser::class)->name('welcome');

