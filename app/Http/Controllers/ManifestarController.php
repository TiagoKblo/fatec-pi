<?php

namespace App\Http\Controllers;

use App\Models\Edital;
use App\Models\ManifestoInteresse;
use App\Models\Matricula;
use App\Models\User;
use Illuminate\Http\Request;

class ManifestarController extends Controller
{
    public function __construct()
    {
        // Define que apenas usuários autenticados podem acessar os métodos do controller
        // Exceto os métodos index e show, que podem ser acessados por qualquer usuário
        $this->middleware('auth')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $manifestos = ManifestoInteresse::all();

        foreach ($manifestos as $manifesto) {
            $manifesto->usuario = User::findOrFail($manifesto->user_id);
            $manifesto->edital = Edital::findOrFail($manifesto->edital);
        }

        return view('manifestar.index')->with('manifestos', $manifestos);
    }


    /*
     * Tela de criação de manifestação
     */
    public function create(Request $request)
    {

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
        $edital = Edital::findOrFail($request->id_edital);
        $user = auth()->user();

        $manifesto = new ManifestoInteresse();
        $manifesto->user_id = $user->getAuthIdentifier();
        $manifesto->edital = $edital->id;

        $matricula = $user->matricula;
        $matricula->grau = $request->input('docente_grau');
        $matricula->pes = $request->input('docente_pes');
        $matricula->celular = $request->input('docente_celular');
        $matricula->telefone = $request->input('docente_telefone');

        $manifesto->partir_de = $request->partir_de;

        // upload do arquivo anexo de pontuacao
        if ($request->hasFile('pontuacao') && $request->file('pontuacao')->isValid()) {
            $anexoName = $this->uploadFile($request->file('pontuacao'), 'anexos/manifestos/pontuacoes');
            $manifesto->pontuacao = $anexoName;
        }

        // upload do arquivo anexo de comprovante
        if ($request->hasFile('comprovante') && $request->file('comprovante')->isValid()) {
            $anexoName = $this->uploadFile($request->file('comprovante'), 'anexos/manifestos/comprovantes');
            $manifesto->comprovante = $anexoName;
        }

        $manifesto->save();

        session()->flash('success', 'Manifestação de interesse cadastrada com sucesso!');

        return redirect()->route('editais.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $manifesto = ManifestoInteresse::findOrFail($id);
        $manifesto->usuario = User::findOrFail($manifesto->user_id);
        $manifesto->edital = Edital::findOrFail($manifesto->edital);

        return view('manifestar.show')->with('manifesto', $manifesto);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->verificarCargos(['administrador', 'coordenador']);

        $this->validate($request, [
            'status' => 'required',
        ]);

        $manifesto = ManifestoInteresse::findOrFail($id);
        $manifesto->status = $request->status;
        $manifesto->motivo_indeferimento = $request->motivo_indeferimento;
        $manifesto->save();

        session()->flash('success', 'Manifestação de interesse atualizada com sucesso!');
        return redirect()->route('manifestar.index');
    }

    /**
     * Mostra a tela de documentos do manifesto
     */
    public function documentos(Request $request, string $manifesto_id)
    {
        $this->verificarCargos(['administrador', 'coordenador']);

        if ($request->method() === 'PATCH') {
            return $this->documentosPatch($request, $manifesto_id);
        } else {
            return $this->documentosGet($manifesto_id);
        }
    }

    public function documentosGet(string $manifesto_id)
    {
        $manifesto = ManifestoInteresse::findOrFail($manifesto_id);
        $manifesto->usuario = User::findOrFail($manifesto->user_id);
        $manifesto->edital = Edital::findOrFail($manifesto->edital);

        return view('manifestar.documentos')->with('manifesto', $manifesto);
    }

    public function documentosPatch(Request $request, string $manifesto_id)
    {
        $this->validate($request, [
            'status_pontuacao' => 'required',
            'status_comprovante' => 'required',
        ]);

        $manifesto = ManifestoInteresse::findOrFail($manifesto_id);

        $manifesto->update([
            'status_pontuacao' => $request->status_pontuacao,
            'status_comprovante' => $request->status_comprovante,
        ]);

        $manifesto->save();

        session()->flash('success', 'Documentos do manifesto atualizados com sucesso!');
        return redirect()->route('manifestar.show', $manifesto->id);
    }

    /**
     * Faz o upload de um arquivo e retorna o nome do arquivo gerado.
     */
    private function uploadFile($file, $destinationPath)
    {
        $extension = $file->extension();
        $anexoName = md5($file->getClientOriginalName() . strtotime("now")) . "." . $extension;
        $file->move(public_path($destinationPath), $anexoName);

        return $anexoName;
    }

    public function verificarCargos($roles = [])
    {
        if (!User::possuiCargos(auth()->user(), $roles)) {
            return redirect()->route('login');
        }
    }
}
