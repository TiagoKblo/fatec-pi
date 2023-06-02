<?php

namespace App\Http\Controllers;

use App\Models\Edital;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EditalController extends Controller
{
    public function index(Request $request) : View
    {
        $curso = $request->query('curso');
        $editais = Edital::where('curso', 'LIKE', "%$curso%")->orderBy('created_at', 'desc')->paginate(10);

        return view('home.index')->with('editais', $editais);
    }
    public function gerenciar()
    {
        $editais = Edital::all();
        return view('editais.gerenciar')->with('editais', $editais);
    }

    public function create() : View | RedirectResponse
    {
        // checar se o usuário está logado
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        return view('editais.create');
    }

    public function show(int $id) : View
    {
        $edital = Edital::findOrFail($id);

        return view('editais.show')->with('edital', $edital);
    }

    public function store(Request $request) : RedirectResponse
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

        session()->flash('success', 'Edital criado com sucesso!');

        return to_route('editais.show', $edital->id);
    }

}
