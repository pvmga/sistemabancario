<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use App\Http\Middleware\CheckIsLogged;
use App\Http\Middleware\CheckIsNotLogged;
use Illuminate\Support\Facades\Route;

Route::middleware([CheckIsNotLogged::class])->group(function () {
    Route::get('/', [AuthController::class, 'index']);
    Route::post('/loginSubmit', [AuthController::class, 'loginSubmit'])->name('loginSubmit');
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/newUser', [MainController::class, 'newUser'])->name('newUser');
});


Route::middleware([CheckIsLogged::class])->group(function () {
    Route::get('/dashboard', [MainController::class, 'dashboard'])->name('dashboard');
    Route::get('/editUser', [MainController::class, 'editUser'])->name('editUser');
    Route::post('/editUserSubmit', [MainController::class, 'editUserSubmit'])->name('editUserSubmit');


    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});
