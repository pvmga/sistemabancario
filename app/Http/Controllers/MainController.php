<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function dashboard() {
        $title = 'MiniBank Dashboard';
        return view('dashboard', compact('title'));
    }
}
