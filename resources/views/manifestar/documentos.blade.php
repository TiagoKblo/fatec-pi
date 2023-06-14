@extends('layouts.base')

@section('main')
    <!-- Main -->
    <main id="principal">
        <h1 class="text-center">Análise de Documentos</h1>
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Detalhes do Manifesto</h5>

                    <table class="table">

                        <thead>
                            <tr>
                                <th>Número do Edital</th>
                                <th>Status da Inscrição</th>
                                <th>Nome do Docente</th>
                                <th>Data de Manifestação</th>
                                <th>Analisar Documentos</th>
                                <th>Deferir/Indeferir Inscrição</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $manifesto->edital->numero_edital }}</td>
                                <td>
                                    <span class="{{ $manifesto->status === 'D' ? 'text-success' : 'text-danger' }}">
                                        @if ($manifesto->status === 'R')
                                            Registrado
                                        @elseif ($manifesto->status === 'D')
                                            Deferido
                                        @elseif ($manifesto->status === 'I')
                                            Indeferido
                                        @elseif ($manifesto->status === 'C')
                                            Convocado
                                        @endif
                                    </span>
                                </td>
                                <td>{{ $manifesto->usuario->name }}</td>
                                <td>{{ $manifesto->partir_de }}</td>
                                <td>
                                    <ul>
                                        @foreach ($manifesto->documentos as $documento)
                                            <li>
                                                <a href="/anexos/{{ $documento->nome }}" class="btn btn-primary">
                                                    Visualizar
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio"
                                            name="status_{{ $manifesto->id }}" value="deferido"
                                            {{ $manifesto->status === 'D' ? 'checked' : '' }}>
                                        <label class="form-check-label">Deferido</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio"
                                            name="status_{{ $manifesto->id }}" value="indeferido"
                                            {{ $manifesto->status === 'I' ? 'checked' : '' }}>
                                        <label class="form-check-label">Indeferido</label>
                                    </div>
                                    <div>
                                        <textarea name="observacoes" class="form-control"
                                            placeholder="Observações"></textarea>
                                    </div>
                                </td>
                                <td>
                                    <a href="{{ route('manifestar.edit', $manifesto->id) }}"
                                        class="btn btn-primary">Enviar</a>
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
