<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EditalController extends Controller
{
    public function index()
    {
        return view('home.index');
    }

    public function create()
    {
        // checar se o usuário está logado
        // if (!auth()->check()) {
        //     return redirect()->route('login');
        // }

        return view('home.cadastroedital');
    }
}
