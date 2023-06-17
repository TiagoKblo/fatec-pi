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
                                    <a href="{{ route('manifestar.documentos', $manifesto->id) }}" class="btn btn-primary">Visualizar</a>
                                </td>
                                <td>
                                    <form action="{{ route('manifestar.update', $manifesto->id) }}" method="post">
                                        @csrf
                                        @method('patch')
                                        <input type="hidden" name="status_atual" id="status_atual" value="{{ $manifesto->status }}">
                                        <div class="form-check form-check-inline mb-2">
                                            <input class="form-check-input" type="radio"
                                                name="status" value="D"
                                                {{ $manifesto->status === 'D' ? 'checked' : '' }}>
                                            <label class="form-check-label">Deferido</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio"
                                                name="status" value="I"
                                                {{ $manifesto->status === 'I' ? 'checked' : '' }}>
                                            <label class="form-check-label">Indeferido</label>
                                        </div>

                                        <textarea name="motivo_indeferimento" id="motivo_indeferimento" cols="30" rows="3"
                                            class="form-control mt-2 mb-2" placeholder="Motivo do Indeferimento">{{ trim($manifesto->motivo_indeferimento) }}</textarea>
                                    </td>
                                    <td>
                                        <input type="submit" value="Enviar" class="btn btn-primary">
                                    </td>
                                </form>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
    <!-- FIM Main -->

<script>
    const $status = document.getElementsByName('status');
    const $motivoIndeferimento = document.getElementById('motivo_indeferimento');
    const $statusServidor = document.getElementById('status_atual').value;

    $motivoIndeferimento.style.display = $statusServidor === 'I' ? 'block' : 'none';

    $status.forEach($radio => {
        $radio.addEventListener('change', () => {
            if ($radio.value === 'I') {
                $motivoIndeferimento.removeAttribute('disabled');
                $motivoIndeferimento.style.display = 'block';
            } else {
                $motivoIndeferimento.setAttribute('disabled', 'disabled');
                $motivoIndeferimento.style.display = 'none';
            }
        });
    });
</script>

@endsection
