@extends('layouts.base')

@section('main')
<!-- Main -->
<main id="principal">
    <h1 class="text-center">Análise de Documentos</h1>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Documentação</h5>
                <table class="table">

                    <thead>
                        <tr>
                            <th>Matrícula</th>
                            <th>Nome do Docente</th>
                            <th>Data de Envio</th>
                            <th>Status da Manifestação</th>
                            <th>Pontuação</th>
                            <th>Documentos</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $manifesto->usuario->id}}</td>
                            <td>{{ $manifesto->usuario->name }}</td>
                            <td>{{ $manifesto->partir_de }}</td>
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
                            <td>
                                <div class="d-flex flex-column">
                                    <a href="/anexos/{{ $manifesto->pontuacao }}" target="_blank" class="btn btn-info">Tabela de Pontuação</a>

                                    <select name="status_pontuacao" class="form-select my-3">
                                        <option value="D" {{ $manifesto->status_pontuacao === 'D' ? 'selected' : '' }}>
                                            Deferir</option>
                                        <option value="I" {{ $manifesto->status_pontuacao === 'I' ? 'selected' : '' }}>
                                            Indeferir</option>
                                    </select>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex flex-column">
                                    <a href="/anexos/{{ $manifesto->comprovante }}" target="_blank" class="btn btn-info">Documentos Comprobatórios</a>

                                    <select name="status_documentos" class="form-select my-3">
                                        <option value="D" {{ $manifesto->status_documentos === 'D' ? 'selected' : '' }}>
                                            Deferir</option>
                                        <option value="I" {{ $manifesto->status_documentos === 'I' ? 'selected' : '' }}>
                                            Indeferir</option>
                                    </select>
                                </div>
                            </td>
                            <td>
                                <a href="{{ route('manifestar.edit', $manifesto->id) }}" class="btn btn-primary">Enviar</a>
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
