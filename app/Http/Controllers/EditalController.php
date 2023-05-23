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
        $edital = new Edital();

        $edital->numero_edital = $request->numero_edital;
        $edital->curso = $request->curso;
        $edital->disciplina = $request->disciplina;
        $edital->turno = $request->turno;
        $edital->horas_aula = $request->horas_aula;
        $edital->dia_da_semana = $request->dia_da_semana;
        $edital->horario_inicio = $request->horario_inicio;
        $edital->horario_fim = $request->horario_fim;
        $edital->prazo = $request->prazo;

        // upload do arquivo anexo
        if ($request->hasFile('anexo_edital') && $request->file('anexo_edital')->isValid()) {
            $requestAnexo = $request->anexo_edital;
            $extension = $requestAnexo->extension();
            $anexoName = md5($requestAnexo->getClientOriginalName() . strtotime("now")) . "." . $extension;
            $requestAnexo->move(public_path('anexos'), $anexoName);
            $edital->anexo_edital = $anexoName;
        }

        $edital->save();

        return redirect()->route('editais.show', $edital->id);
    }
}
