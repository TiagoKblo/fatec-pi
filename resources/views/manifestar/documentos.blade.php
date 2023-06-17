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
                                    <a href="#" onclick="abrirModal('modalPontuacao')" class="btn btn-info">Tabela de Pontuação</a>
                                    <br>
                                    <select name="status_pontuacao">
                                        <option value="D" {{ $manifesto->status_pontuacao === 'D' ? 'selected' : '' }}>
                                            Deferir</option>
                                        <option value="I" {{ $manifesto->status_pontuacao === 'I' ? 'selected' : '' }}>
                                            Indeferir</option>
                                    </select>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex flex-column">
                                    <a href="#" onclick="abrirModal('modalDocumentos')" class="btn btn-info">Documentos Comprobatórios</a>
                                    <br>
                                    <select name="status_documentos">
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

<!-- Modal Tabela de Pontuação -->
<div class="modal fade" id="modalPontuacao" tabindex="-1" role="dialog" aria-labelledby="modalPontuacaoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalPontuacaoLabel">Tabela de Pontuação</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Conteúdo da tabela de pontuação -->
                <iframe src="anexo/{{ $manifesto->pontuacao }}" width="100%" height="600"></iframe>
            </div>
        </div>
    </div>
</div>

<!-- Modal Documentos Comprobatórios -->
<div class="modal fade" id="modalDocumentos" tabindex="-1" role="dialog" aria-labelledby="modalDocumentosLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDocumentosLabel">Documentos Comprobatórios</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Conteúdo dos documentos comprobatórios -->
                <iframe src="anexo/{{ $manifesto->documentos }}" width="100%" height="600"></iframe>
            </div>
        </div>
    </div>
</div>
@endsection

<script>
    function abrirModal(modalId) {
        $('#' + modalId).modal('show');
    }
</script>
