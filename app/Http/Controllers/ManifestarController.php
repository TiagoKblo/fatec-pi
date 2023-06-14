<?php

namespace App\Http\Controllers;

use App\Models\Edital;
use App\Models\ManifestoInteresse;
use App\Models\Matricula;
use App\Models\User;
use Illuminate\Http\Request;

class ManifestarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $manifestos = ManifestoInteresse::all();

        foreach ($manifestos as $manifesto)
        {
            $manifesto->usuario = User::find($manifesto->user);
            $manifesto->edital = Edital::find($manifesto->edital);
        }


        return view('manifestar.index')->with('manifestos', $manifestos);
    }


    /*
     * Tela de criação de manifestação
     */
    public function create(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $id = $request->query('id_edital');

        $edital = Edital::findOrFail($id);
        $matricula = auth()->user()->matricula;

        return view('manifestar.create')->with('edital', $edital)->with('matricula', $matricula);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $edital = Edital::findOrFail($request->id_edital);

        $manifesto = new ManifestoInteresse();
        $manifesto->user_id = auth()->user()->getAuthIdentifier();
        $manifesto->edital = $edital->id;

        $matricula = Matricula::find(auth()->user()->matricula->id);
        $matricula->grau = $request->docente_grau;
        $matricula->pes = $request->docente_pes;
        $matricula->celular = $request->docente_celular;
        $matricula->telefone = $request->docente_telefone;
        $matricula->save();

        $manifesto->partir_de = $request->partir_de;

        // upload do arquivo anexo de pontuacao
        if ($request->hasFile('pontuacao') && $request->file('pontuacao')->isValid()) {
            $requestAnexo = $request->pontuacao;
            $extension = $requestAnexo->extension();
            $anexoName = md5($requestAnexo->getClientOriginalName() . strtotime("now")) . "." . $extension;
            $requestAnexo->move(public_path('anexos/manifestos/pontuacoes'), $anexoName);
            $manifesto->pontuacao = $anexoName;
        }

        // upload do arquivo anexo de comprovante
        if ($request->hasFile('comprovante') && $request->file('comprovante')->isValid()) {
            $requestAnexo = $request->comprovante;
            $extension = $requestAnexo->extension();
            $anexoName = md5($requestAnexo->getClientOriginalName() . strtotime("now")) . "." . $extension;
            $requestAnexo->move(public_path('anexos/manifestos/comprovantes'), $anexoName);
            $manifesto->comprovante = $anexoName;
        }

        $manifesto->save();

        session()->flash('success', 'Manifestação de interesse cadastrada com sucesso!');

        return to_route('editais.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $manifesto = ManifestoInteresse::findOrFail($id);
        $manifesto->edital = Edital::findOrFail($manifesto->edital);
        $manifesto->usuario = User::findOrFail($manifesto->user_id);

        return view('manifestar.show')->with('manifesto', $manifesto);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $manifesto = ManifestoInteresse::with('users')->findOrFail($id);
        return view('manifestar.edit')->with('manifesto', $manifesto);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
