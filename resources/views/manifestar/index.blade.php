@extends('layouts.base')

@section('main')
    <!-- Main -->
    <main id="principal">
        <h1 class="text-center">Gerenciamento de Manifestações</h1>
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Lista de Editais</h5>
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
                                 <td>
    <span class="{{ $manifesto->edital->status === 'A' ? 'text-success' : 'text-danger' }}">
        @if ($manifesto->edital->status === 'A')
            Aberto
        @elseif ($manifesto->edital->status === 'F')
            Finalizado
        @elseif ($manifesto->edital->status === 'C')
            Cancelado
        @elseif ($manifesto->edital->status === 'CA')
            Cadastrado
        @elseif ($manifesto->edital->status === 'P')
            Publicado
        @elseif ($manifesto->edital->status === 'E')
            Errata
        @elseif ($manifesto->edital->status === 'CN')
            Cancelado (Sem Inscrições)
        @elseif ($manifesto->edital->status === 'RI')
            Recebendo Inscrições
        @elseif ($manifesto->edital->status === 'RR')
            Em Análise
        @elseif ($manifesto->edital->status === 'RP')
            Deferimentos Publicados
        @elseif ($manifesto->edital->status === 'FI')
            Finalizado sem Inscritos
        @elseif ($manifesto->edital->status === 'RP')
            Resultado Parcial Publicado
        @elseif ($manifesto->edital->status === 'RR')
            Recebendo Recursos
        @elseif ($manifesto->edital->status === 'AR')
            Analisando Recursos
        @elseif ($manifesto->edital->status === 'RP')
            Resultado Publicado
        @elseif ($manifesto->edital->status === 'FI')
            Finalizado
        @endif
    </span>
</td>

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
