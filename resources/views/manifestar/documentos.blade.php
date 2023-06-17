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
                                <th>Data de Manifestação</th>
                                <th>Analisar Documentos</th>
                                <th>Status do Documento</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $manifesto->edital->numero_edital }}</td>
                                <td>{{ $manifesto->usuario->name }}</td>
                                <td>{{ $manifesto->partir_de }}</td>
                                <td>
                                    <select name="status_pontuacao">
                                        <option value="D" {{ $manifesto->status_pontuacao === 'D' ? 'selected' : '' }}>
                                            Deferido</option>
                                        <option value="I" {{ $manifesto->status_pontuacao === 'I' ? 'selected' : '' }}>
                                            Indeferido</option>
                                    </select>
                                    <br>
                                    <select name="status_comprovante">
                                        <option value="D" {{ $manifesto->status_comprovante === 'D' ? 'selected' : '' }}>
                                            Deferido</option>
                                        <option value="I" {{ $manifesto->status_comprovante === 'I' ? 'selected' : '' }}>
                                            Indeferido</option>
                                    </select>
                                </td>
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
                                    <a href="{{ route('manifestar.edit', $manifesto->id) }}"
                                        class="btn btn-primary">Enviar</a>
                                    <a href="anexo/{{ $manifesto->pontuacao }}"  class="btn btn-info">Tabela de
                                        Pontuação</a>
                                    <a href="anexo/{{ $manifesto->documentos }}"
                                        class="btn btn-info">Documentos Comprobatórios</a>
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
