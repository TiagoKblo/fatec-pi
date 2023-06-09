@extends('layouts.base')

@section('main')
    <!-- Main -->
    <main id="principal">
        <h1 class="text-center">Informações da Manifestação de Edital</h1>
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Detalhes do Manifesto</h5>

                    <table class="table">

                        <thead>
                            <tr>
                                <th>Número do Edital</th>
                                <th>Status da Inscrição</th>
                                <th>ID do Docente</th>
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

                                <td>{{ $manifesto->usuario->id }}</td>
                                <td>{{ $manifesto->partir_de }}</td>
                                <td>
                                    <a href="/anexos/{{ $manifesto->pontuacao }}" class="btn btn-primary">Visualizar</a>
                                </td>
                                <td>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status_{{ $manifesto->id }}"
                                            value="deferido" {{ $manifesto->status === 'deferido' ? 'checked' : '' }}>
                                        <label class="form-check-label">Deferido</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status_{{ $manifesto->id }}"
                                            value="indeferido" {{ $manifesto->status === 'indeferido' ?: '' }}>
                                        <label class="form-check-label">Indeferido</label>
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
