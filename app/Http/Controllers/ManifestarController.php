<?php

namespace App\Http\Controllers;

use App\Models\Edital;
use App\Models\ManifestoInteresse;
use Illuminate\Http\Request;

class ManifestarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $manifestos = ManifestoInteresse::all();
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

        return view('manifestar.create')->with('edital', $edital);
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
        $manifesto->usuario = auth()->user()->getAuthIdentifier();
        $manifesto->edital = $edital->id;
        $manifesto->docente_unidade = $request->docente_unidade;
        $manifesto->docente_grau = $request->docente_grau;
        $manifesto->docente_pes = $request->docente_pes;
        $manifesto->docente_celular = $request->docente_celular;
        $manifesto->docente_telefone = $request->docente_telefone;
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
        //
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
