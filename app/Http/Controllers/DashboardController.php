<?php

namespace App\Http\Controllers;

use App\Models\User;

class DashboardController extends Controller
{
    public function __construct()
    {
        // Define os middlewares de autenticação e verificação de email verificado
        $this->middleware(['auth', 'verified']);
    }

    public function index()
    {
        // Se o usuário não for admin ou coordenador, redireciona para a página de editais
        if (!User::possuiCargos(auth()->user(), ['ADMINISTRADOR', 'COORDENADOR'])) {
            return redirect()->route('editais.index');
        }

        // Renderiza a view do painel de controle
        return view('dashboard.index');
    }

    public function usuarios()
    {
        // Obtém todos os usuários
        $usuarios = User::all();

        // Renderiza a view de usuários com os dados dos usuários
        return view('dashboard.usuarios')->with('usuarios', $usuarios);
    }
}
