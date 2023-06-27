@extends('layouts.base')

@section('main')
    <!-- Main -->
    <main id="principal">
        <h1 class="text-center">Gerenciamento de Editais</h1>
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Lista de Editais</h5>

                    <table class="table">

                        <thead>
                            <tr>
                                <th>Número do Edital</th>
                                <th>Disciplina</th>
                                <th>Status</th>
                                <th>Ações</th>
                                <td>
                                    <a href="{{ route('editais.create') }}" class="btn btn-primary">Criar</a>
                                </td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($editais as $edital)
                                <tr>
                                    <td>{{ $edital->numero_edital }}</td>
                                    <td>{{ $edital->disciplina }}</td>
                                    <td>{{ $edital->getStatusName()}}</td>
                                    <td>
                                        <a href="{{ route('editais.show', $edital->id) }}" class="btn btn-primary">Ver
                                            Detalhes</a>
                                        <a href="{{ route('manifestar.index', $edital->id) }}"
                                            class="btn btn-primary">Manifestações de Interesse</a>
                                        <a href="{{ route('editais.edit', $edital->id) }}"
                                            class="btn btn-secondary">Editar</a>
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
