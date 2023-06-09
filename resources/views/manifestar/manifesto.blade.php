@extends('layouts.base')

@section('main')
    <!-- Main -->
    <main id="principal">
        <h1 class="text-center">Detalhes do Manifesto de Edital</h1>
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Detalhes do Manifesto</h5>

                    <table class="table">

                        <thead>
                            <tr>
                                <th>ID do Edital</th>
                                <th>ID do Manifesto</th>
                                <th>ID do Docente</th>
                                <th>Data de Manifestação</th>
                                <th>Tabela de Pontuação</th>
                                <th>Comprovante</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $manifesto->edital->id }}</td>
                                <td>{{ $manifesto->id }}</td>
                                <td>{{ $manifesto->usuario->id }}</td>
                                <td>{{ $manifesto->partir_de }}</td>
                                <td>
                                    <a href="{{ $manifesto->pontuacao }}" class="btn btn-primary">Visualizar</a>
                                </td>
                                <td>
                                    <a href="{{ $manifesto->comprovante }}" class="btn btn-primary">Visualizar</a>
                                </td>
                                <td>
                                    <form action="{{ route('manifestar.destroy', $manifesto->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Excluir</button>
                                    </form>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
    <!-- FIM Main -->
@endsection
