@extends('layouts.base')

@section('main')
    <!-- Main -->
    <main id="principal">
        <h1 class="text-center">Gerenciamento de Manifestações</h1>
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Lista de Candidatos</h5>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Número do Edital</th>
                                <th scope="col">Status</th>
                                <th scope="col">Data da Inscrição</th>
                                <th scope="col">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($manifestos as $manifesto)
                                <tr>
                                    <th scope="row">{{ $manifesto->id }}</th>
                                    <td>{{ $manifesto->edital->numero_edital }}</td>
                                    <td>{{ $manifesto->status }}</td>
                                    <td>{{ Carbon\Carbon::parse($manifesto->created_at)->format('d/m/Y') }}</td>
                                    <td>
                                        <a href="{{ route('manifestar.show', $manifesto->id) }}" class="btn btn-primary">Visualizar</a>

                                        <a href="{{ route('manifestar.edit', $manifesto->id) }}" class="btn btn-secondary">Editar</a>
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
