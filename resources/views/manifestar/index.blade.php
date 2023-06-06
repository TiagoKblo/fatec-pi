@extends('layouts.base')

@section('main')
    <!-- Main -->
    <main id="principal">
        <h1 class="text-center">Gerenciamento de Manifestações</h1>
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Lista de Candidatos</h5>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID do Edital</th>
                                <th>ID do Manifesto</th>
                                <th>ID do Docente</th>
                                <th>Data de Manifestação</th>
                                <th>Tabela de Pontuação</th>
                                <th>Visualizar Comprovante</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($manifestos as $manifesto)
                                <tr>
                                    <td>{{ $manifesto->id }}</td>
                                    <td>{{ $manifesto->usuario }}</td>
                                    <td>{{ $manifesto->edital }}</td>
                                    <td>{{ $manifesto->partir_de }}</td>
                                    <td>
                                        <a href="{{ $manifesto->pontuacao }}" class="text-blue-500 underline">Pontuação</a>
                                    </td>
                                    <td>
                                        <a href="{{ $manifesto->comprovante }}"
                                            class="text-blue-500 underline">Comprovante</a>
                                    </td>
                                    <td>
                                        <a href="{{ route('manifestar.show', $manifesto->id) }}"
                                            class="text-blue-500 underline">Ver Detalhes</a>
                                    </td>
                                    <td>
                                        <form action="{{ route('manifestar.destroy', $manifesto->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <input type="submit" value="Excluir"
                                                class="text-blue-500 underline cursor-pointer">
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
    <!-- FIM Main -->
@endsection
