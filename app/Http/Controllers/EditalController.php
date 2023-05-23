<?php

namespace App\Http\Controllers;

use App\Models\Edital;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class EditalController extends Controller
{
    public function index()
    {
        return view('home.index');
    }

    public function create()
    {
        // checar se o usuário está logado
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        return view('editais.create');
    }

    public function show(int $id)
    {
        $edital = Edital::find($id);

        $semana = ["Domingo", "Segunda", "Terça", "Quarta", "Quinta", "Sexta", "Sábado"];

        return view('editais.show')->with('edital', $edital)->with('semana', $semana);
    }

    public function store(Request $request)
    {
        $edital = Edital::create($request->all());
        $path = $request->file('anexo_edital')->store('anexo_editais');
        $edital->anexo_edital=$path;
        return Redirect(route('editais.show', ["editai" => $edital->id]));
    }
}
