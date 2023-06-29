<?php

namespace App\Http\Controllers;

use App\Models\Edital;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EditalController extends Controller
{
    public function __construct()
    {
        // Define que apenas usuários autenticados podem acessar os métodos do controller
        // Exceto os métodos index e show, que podem ser acessados por qualquer usuário
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index(Request $request): View
    {
        // Obtém os parâmetros da consulta
        $curso = $request->query('curso');
        $numero_edital = $request->query('numero_edital');
        $status = $request->query('status');
        $tipo_vaga = $request->query('vaga');

        // Realiza a consulta dos editais com base nos parâmetros e ordenação
        $editais = Edital::where('curso', 'like', "%$curso%")
            ->where('numero_edital', 'like', "%$numero_edital%")
            ->where('status', 'like', "%$status%")
            ->where('prazo', 'like', "%$tipo_vaga%")
            ->orderBy('status', 'asc')
            ->orderBy('created_at', 'desc')
            ->orderBy('numero_edital', 'asc')
            ->paginate(10);

        // Retorna a view com os editais
        return view('home.index')->with('editais', $editais);
    }

    public function gerenciar(): View
    {
        // Obtém todos os editais ordenados por status e outros critérios
        $editais = Edital::orderBy('status', 'asc')
            ->orderBy('numero_edital', 'asc')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // Retorna a view de gerenciamento de editais com os editais
        return view('editais.gerenciar')->with('editais', $editais);
    }

    public function create(): View | RedirectResponse
    {
        // Retorna a view de criação de edital
        return view('editais.create');
    }

    public function show(int $id): View
    {
        // Obtém o edital pelo ID fornecido
        $edital = Edital::findOrFail($id);

        // Retorna a view de exibição do edital com o edital correspondente
        return view('editais.show')->with('edital', $edital);
    }

    public function store(Request $request): RedirectResponse
    {

        // Valida os dados da requisição
        $request->validate([
            'numero_edital' => 'required',
            'curso' => 'required',
            'disciplina' => 'required',
            'anexo_edital' => 'required|mimes:pdf|max:2048', // Exemplo de validação de arquivo (PDF de até 2MB)
        ]);

        // Cria um novo edital e define os valores a partir dos dados da requisição
        $edital = Edital::create([
            'numero_edital' => $request->numero_edital,
            'curso' => $request->curso,
            'disciplina' => $request->disciplina,
            'turno' => $request->turno,
            'horas_aula' => $request->horas_aula,
            'dia_da_semana' => $request->dia_da_semana,
            'horario_inicio' => $request->horario_inicio,
            'horario_fim' => $request->horario_fim,
            'prazo' => $request->prazo,
        ]);

        // Upload do arquivo anexo
        if ($request->hasFile('anexo_edital') && $request->file('anexo_edital')->isValid()) {
            $requestAnexo = $request->anexo_edital;
            $extension = $requestAnexo->extension();
            $anexoName = md5($requestAnexo->getClientOriginalName() . strtotime("now")) . "." . $extension;
            $requestAnexo->move(public_path('anexos'), $anexoName);
            $edital->anexo_edital = $anexoName;
        }

        // Salva o edital no banco de dados
        $edital->save();

        // Define uma mensagem de sucesso na sessão
        session()->flash('success', 'Edital criado com sucesso!');

        // Redireciona para a rota de exibição do edital criado
        return to_route('editais.show', $edital->id);
    }

    public function edit(int $id): View
    {


        // Obtém o edital pelo ID fornecido
        $edital = Edital::findOrFail($id);

        // Retorna a view de edição do edital com o edital correspondente
        return view('editais.edit')->with('edital', $edital);
    }

    public function update(Request $request, int $id): RedirectResponse
    {


        // Obtém o edital pelo ID fornecido
        $edital = Edital::findOrFail($id);

        // Atualiza os valores do edital com base nos dados da requisição
        $edital->update($request->only([
            'numero_edital',
            'curso',
            'disciplina',
            'turno',
            'horas_aula',
            'dia_da_semana',
            'horario_inicio',
            'horario_fim',
            'prazo',
            'status',
        ]));

        // Salva as alterações do edital no banco de dados
        $edital->save();

        // Define uma mensagem de sucesso na sessão
        session()->flash('success', 'Edital atualizado com sucesso!');

        // Redireciona para a rota de exibição do edital atualizado
        return redirect()->route('editais.show', $edital->id);
    }
}
