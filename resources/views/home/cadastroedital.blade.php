@extends('layouts.base')

@section('main')
    <!-- Main -->
    <main id="principal">
        <h1 class="text-center">Cadastrar Edital</h1>
        <div class="container">
            <div class="card">
                <form action="#" method="post">
                    <div class="card-body">
                        <h5 class="card-title">Formulário de Cadastro de Edital</h5>

                        <div class="form-group">
                            <label for="numero_edital">Número do Edital:</label>
                            <input type="text" class="form-control" id="numero_edital" name="numero_edital"
                                placeholder="Ex: 001/2023" required>
                        </div>

                        <div class="form-group">
                            <label for="curso">Curso:</label>
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


                        <div class="form-group">
                            <label for="disciplina">Nome da Disciplina:</label>
                            <input type="text" class="form-control" id="disciplina" name="disciplina"
                                placeholder="Ex: Programação Avançada" required>
                        </div>
                        <div class="form-group row">
                            <div class="col">
                                <label for="turno">Turno:</label>
                                <div>
                                    <input type="radio" name="turno" id="noturno" value="Noturno">
                                    <label for="noturno">Noturno</label>
                                </div>
                                <div>
                                    <input type="radio" name="turno" id="diurno" value="Diurno">
                                    <label for="diurno">Diurno</label>
                                </div>
                                <div class="form-group">
                                    <label for="horas_aula">Horas aula:</label>
                                    <input type="number" class="form-control" id="horas_aula" name="horas_aula"
                                        value="2" min="0" required>
                                    <small>Informe o número de horas-aula.</small>
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="dia_semana">Dia da Semana:</label>
                            <select class="form-control" id="dia_semana" name="dia_semana" required>
                                <option value="">Selecione o dia da semana</option>
                                <option value="Segunda-feira">Segunda-feira</option>
                                <option value="Terça-feira">Terça-feira</option>
                                <option value="Quarta-feira">Quarta-feira</option>
                                <option value="Quinta-feira">Quinta-feira</option>
                                <option value="Sexta-feira">Sexta-feira</option>
                                <option value="Sábado">Sábado</option>
                                <option value="Domingo">Domingo</option>
                            </select>
                        </div>


                        <div class="form-group">
                            <label for="horario">Horário de Oferecimento:</label>
                            <input type="text" class="form-control" id="horario" name="horario"
                                placeholder="Ex: 14:00 - 16:00" required>
                        </div>

                        <div class="form-group">
                            <label for="prazos">Prazos:</label>
                            <textarea class="form-control" id="prazos" name="prazos" placeholder="Informe os prazos" required></textarea>
                        </div>
                    </div>
                    <div class="card-footer row">
                        <label for="anexar-edital">Anexar Edital:</label>
                        <input type="file" name="anexar-edital" id="anexar-edital" class="form-control labeled"
                            accept=".pdf">
                        <small>Selecione o arquivo do edital para anexar (.pdf).</small>
                    </div>

                    <div class="card-footer row">
                        <p class="col"><input type="reset" value="Limpar todos os campos" class="form-control btn"></p>
                        <p class="col"><input type="submit" value="Cadastrar Edital"
                                class="form-control btn btn-danger"></a>
                    </div>
            </div>
            </form>
        </div>
        </div>
    </main>
    <!-- FIM Main -->
@endsection
