<?php

namespace App\Http\Controllers;

use App\Models\User;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function index() {
        return view('dashboard.index');
    }

    public function usuarios()
    {
        $usuarios = User::all();
        return view('dashboard.usuarios')->with('usuarios', $usuarios);
    }
}
