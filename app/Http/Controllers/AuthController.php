<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index() {
        $title = 'Login - MiniBank';
        return view('login', compact('title'));
    }

    public function register() {
        $title = 'Cadastro - MiniBank';
        return view('register', compact('title'));
    }
}
