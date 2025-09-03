<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;


Route::view('/', 'index');
Route::view('/login', 'auth.login')->name('login');
Route::view('/register', 'auth.register')->name('register');
Route::view('/tasks', 'tasks.index')->middleware('auth');
