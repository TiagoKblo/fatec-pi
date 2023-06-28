@extends('layouts.base')

@section('main')
<!-- Main -->
<main id="principal">
    <h1 class="text-center">Manifestação de Interesse</h1>
    <div class="container">
        <div class="card">
            <form action="{{ route('manifestar.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="id_edital" value="{{ $edital->id }}">

                <div class="card-body">
                    <h5 class="card-title">Formulário de Manifestação</h5>

                    <div class="form-group" >
                        <label for="fatec-cidade">Faculdade de Tecnologia de</label>
                        <input type="text" class="form-control labeled" readonly id="fatec-cidade" value="Itapira">
                    </div>

                    <div class="form-group row">
                        <div class="col">
                            <label for="fatec-nome">Nome da Unidade:</label>
                            <input type="text" class="form-control labeled" readonly
                                   id="fatec-nome" name="docente_unidade"
                                   value="{{ $matricula->unidade ?? 'Fatec Itapira - Ogari de Castro Pacheco' }}" required>
                        </div>

                        <div class="col">
                            <label for="fatec-edital">N° de Edital:</label>
                            <input type="text" class="form-control labeled" readonly
                                   id="fatec-edital" value="{{ $edital->numero_edital }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="candidato-nome">Nome do(a) Docente:</label>
                        <input type="text" class="form-control labeled"
                               id="candidato-nome" value="{{ Auth::user()->name }}" readonly>
                    </div>

                    <div class="form-group">
                        <label for="candidato-email">E-mail institucional:</label>
                        <input type="email" class="form-control labeled"
                               id="candidato-email" placeholder="seu.nome@fatec.sp.gov.br"
                               readonly value="{{ Auth::user()->email }}">
                    </div>

                    <div class="form-group row">
                        <div class="col">
                            <label for="candidato-telefone">Telefone (Residencial):</label>
                            <input type="number" class="form-control labeled" id="candidato-telefone" name="docente_telefone" required value="{{ $matricula->telefone ?? '' }}">
                        </div>

                        <div class="col">
                            <label for="candidato-celular">Celular:</label>
                            <input type="number" class="form-control labeled" id="candidato-celular" name="docente_celular" required value="{{ $matricula->celular ?? '' }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col">
                            <label for="contrato-prazo">Contrato por tempo: </label>
                            <p>
                                <input type="radio" disabled
                                       id="contrato-prazo" {{ $edital->prazo === "I" ? 'checked' : '' }}> Indeterminado
                                <input type="radio" disabled
                                       id="contrato-prazo" {{ $edital->prazo === "D" ? 'checked' : '' }}
                                > Determinado
                            </p>
                        </div>

                        <div class="col">
                            <label for="contrato-data">a partir de:</label>
                            <input type="date" class="form-control labeled" id="contrato-data" name="partir_de" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col">
                            <label for="categoria-docente">Categoria do docente:</label>
                            <p>
                                <input type="radio" name="docente_pes" id="categoria-docente-pes" value="3" required> PES III
                                <input type="radio" name="docente_pes" id="categoria-docente-pes" value="2" required> PES II
                                <input type="radio" name="docente_pes" id="categoria-docente-pes" value="1" required> PES I
                            </p>
                        </div>

                        <div class="col">
                            Grau <input type="text" name="docente_grau" id="categoria-docente-grau" class="form-control labeled" size="1" value="{{ $matricula->grau ?? '' }}" required>
                        </div>
                    </div>

                    <div class="card-text">
                        <p>
                            <strong><a href="https://cesu.cps.sp.gov.br/wp-content/uploads/2022/08/ANEXO-IV-Instrucao-Cesu-7-2022-2.xlsx" style="text-decoration: underline; color: blue">Anexar a tabela de pontuação (Anexo IV)</a>, devidamente preenchida, e a documentação comprobatória para a análise e validação da comissão avaliadora.</strong>
                        </p>
                    </div>

                    <div class="card-text row mb-2">
                        <div class="col">
                            <label for="tabela-pontuacao">Tabela de Pontuação</label>
                            <input type="file" name="pontuacao" id="tabela-pontuacao" class="form-control labeled" accept=".pdf" required>
                        </div>

                        <div class="col">
                            <label for="comprovante">Documentos Comprobatórios</label>
                            <input type="file" name="comprovante" id="comprovante" class="form-control labeled" accept=".zip,.rar" required>
                        </div>
                    </div>

                    <div class="card-text">
                        <input type="radio" name="aceitar-termos" id="manifesto-aceitar-termos" class="form-check-input" required>
                        <strong>Declaro ser o responsável pelo correto preenchimento do anexo IV e pela entrega da documentação comprobatória no ato da inscrição, sob pena de ter minha inscrição indeferida, nos termos da Instrução CESU 7/2022. Estou ciente que não poderei anexar à minha inscrição documentos a posteriori.</strong>
                    </div>
                </div>
                <div class="card-footer row">
                    <p class="col"><input type="reset" value="Limpar todos os campos" class="form-control btn"></p>
                    <p class="col"><input type="submit" disabled id="manifesto-form-submit" value="Enviar Manifestação de Interesse" class="form-control btn btn-danger"></p>
                </div>
            </form>
        </div>
    </div>
</main>
<!-- FIM Main -->
@endsection

@section('scripts')
    <script>
        let $manifestarTermos = document.getElementById('manifesto-aceitar-termos');
        $manifestarTermos.onclick = function () {
            let $btnManifestoSubmit = document.getElementById('manifesto-form-submit');
            $btnManifestoSubmit.disabled = false;
        }
    </script>
@endsection



