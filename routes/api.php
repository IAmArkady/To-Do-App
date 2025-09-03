<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::prefix('auth')->group(function () {
    Route::post('register', [AuthController::class, 'register'])->middleware('guest');
    Route::post('login',    [AuthController::class, 'login'])->middleware('guest');
    Route::post('logout',   [AuthController::class, 'logout'])->middleware('auth:sanctum');
});

Route::middleware(['auth:sanctum', 'cors'])->group(function () {
    Route::apiResource('tasks', TaskController::class);
});
