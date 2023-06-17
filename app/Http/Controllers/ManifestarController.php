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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }
        elseif (!User::possuiCargos(auth()->user(), ['administrador', 'coordenador'])) {
            return redirect()->route('home');
        }

        $manifesto = ManifestoInteresse::findOrFail($id);
        $manifesto->status = $request->status;
        $manifesto->motivo_indeferimento = $request->motivo_indeferimento;
        $manifesto->save();

        session()->flash('success', 'Manifestação de interesse atualizada com sucesso!');
        return redirect()->route('manifestar.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Mostra a tela de documentos do manifesto
     */
    public function documentos(Request $request, string $manifesto_id)
    {
        if (!auth()->check()) return redirect()->route('login');
        if ($request->method() === 'PATCH') return $this->documentosPatch($request, $manifesto_id);
        else return $this->documentosGet($manifesto_id);
    }

    public function documentosGet(string $manifesto_id)
    {
        $manifesto = ManifestoInteresse::findOrFail($manifesto_id);

        $manifesto->edital = Edital::findOrFail($manifesto->edital);
        $manifesto->usuario = User::findOrFail($manifesto->user_id);

        return view('manifestar.documentos')->with('manifesto', $manifesto);
    }

    public function documentosPatch(Request $request, string $manifesto_id)
    {
        if (!auth()->check()) return redirect()->route('login');
        if (!User::possuiCargos(auth()->user(), ['administrador', 'coordenador'])) return redirect()->route('home');

        $manifesto = ManifestoInteresse::findOrFail($manifesto_id);

        $manifesto->status_pontuacao = $request->status_pontuacao;
        $manifesto->status_comprovante = $request->status_comprovante;

        $manifesto->save();

        session()->flash('success', 'Documentos do manifesto atualizados com sucesso!');
        return redirect()->route('manifestar.show', $manifesto->id);
    }
}
