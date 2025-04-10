<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('login');
// });

Route::get('/', [AuthController::class, 'index']);
Route::get('/register', [AuthController::class, 'register']);
Route::get('/dashboard', [MainController::class, 'dashboard']);
