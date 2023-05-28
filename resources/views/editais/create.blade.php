@extends('layouts.base')

@section('main')
    <!-- Main -->
    <main id="principal">
        <h1 class="text-center">Cadastrar Edital</h1>
        <div class="container">
            <div class="card">
                <form action="{{ route('editais.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <h5 class="card-title">Formulário de Cadastro de Edital</h5>

                        <div class="form-group mt-2">
                            <label for="numero_edital" class="mb-2">Número do Edital:</label>
                            <input type="text" class="form-control" id="numero_edital" name="numero_edital"
                                placeholder="Ex: 001/2023" required>
                        </div>

{{--                        <div class="form-group mt-2">--}}
{{--                            <label for="descricao" class="mb-2">Descrição:</label>--}}
{{--                            <textarea class="form-control" id="descricao" name="descricao"--}}
{{--                                      placeholder="Adicione uma descrição ao edital" rows="3" required></textarea>--}}
{{--                        </div>--}}

                        <div class="form-group mt-2">
                            <label for="curso" class="mb-2">Curso:</label>
                            <select class="form-control" id="curso" name="curso" required>
                                <optgroup label="Cursos Disponíveis">
                                    <option value="DSM" selected>Tecnologia em Desenvolvimento de Software
                                        Multiplataforma</option>
                                    <option value="GTI">Tecnologia em Gestão da Tecnologia da Informação</option>
                                    <option value="PI">Tecnologia em Gestão da Produção Industrial</option>
                                    <option value="GE">Tecnologia em Gestão Empresarial</option>
                                </optgroup>
                            </select>
                        </div>


                        <div class="form-group mt-2">
                            <label for="disciplina" class="mb-2">Nome da Disciplina:</label>
                            <input type="text" class="form-control" id="disciplina" name="disciplina"
                                placeholder="Ex: Programação Avançada" required>
                        </div>
                        <div class="form-group row">
                            <div class="col">
                                <p class="mt-3">
                                    <label for="turno">Turno:</label>
                                    <input type="radio" name="turno" id="noturno" value="Noturno" checked>
                                    <label for="noturno">Noturno</label>
                                    <input type="radio" name="turno" id="diurno" value="Diurno">
                                    <label for="diurno">Diurno</label>
                                </p>
                                <div class="form-group">
                                    <label for="horas_aula">Horas aula:</label>
                                    <input type="number" class="form-control" id="horas_aula" name="horas_aula"
                                        value="2" min="0" required>
                                    <small>Informe o número de horas-aula.</small>
                                </div>
                            </div>
                        </div>


                        <div class="form-group mt-2">
                            <label for="dia_semana" class="mb-2">Dia da Semana:</label>
                            <select class="form-control" id="dia_semana" name="dia_da_semana" required>
                                <option value="">Selecione o dia da semana</option>
                                <option value="0">Domingo</option>
                                <option value="1">Segunda-feira</option>
                                <option value="2">Terça-feira</option>
                                <option value="3">Quarta-feira</option>
                                <option value="4">Quinta-feira</option>
                                <option value="5">Sexta-feira</option>
                                <option value="6">Sábado</option>
                            </select>
                        </div>


                        <div class="form-group mt-2 row">
                            <label>Horário de Oferecimento:</label>

                            <div class="col date">
                                <p>Horário Início</p>
                                <input type="time" class="form-control" name="horario_inicio">
                            </div>

                            <div class="col date">
                                <p>Horário Fim</p>
                                <input type="time" class="form-control" name="horario_fim">
                            </div>
                        </div>

                        <div class="form-group mt-2">
                            <label for="prazo" class="mb-2">Prazos:</label>
                            <input type="radio" id="prazo" name="prazo" value="determinado" checked> Determinado
                            <input type="radio" id="prazo" name="prazo" value="indeterminado">
                            Indeterminado
                        </div>
                    </div>
                    <div class="card-footer">

                    </div>

                    <div class="card-footer row" class="mb-2">
                        <div class="col">
                            <label for="anexar-edital" class="mb-2">Anexar Edital:</label>
                            <input type="file" name="anexo_edital" id="anexar-edital" class="form-control labeled">
                            <small>Selecione o arquivo do edital para anexar (.pdf).</small>
                        </div>
                        <div class="col">
                            <p><input type="reset" value="Limpar todos os campos" class="form-control btn"></p>
                            <p><input type="submit" value="Cadastrar Edital" class="form-control btn btn-danger"></a>
                        </div>
                    </div>
            </div>
            </form>
        </div>
        </div>
    </main>
    <!-- FIM Main -->
@endsection
