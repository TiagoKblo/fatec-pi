@extends('layouts.base')

@section('main')
    <!-- Main -->
    <main id="principal">
        <h1 class="text-center">Cadastrar Edital</h1>
        <div class="container">
            <div class="card">
                <form action="{{ route('editais.update', $edital->id) }}" method="POST" enctype="multipart/form-data">
                    @method('patch')
                    @csrf
                    <div class="card-body">
                        <h5 class="card-title">Formulário de Cadastro de Edital</h5>

                        <div class="form-group mt-2">
                            <label for="numero_edital" class="mb-2">Número do Edital:</label>
                            <input type="text" class="form-control" id="numero_edital" name="numero_edital"
                                placeholder="Ex: 001/2023" value="{{ $edital->numero_edital }}" required>
                        </div>

                        <div class="form-group mt-2">
                            <label for="curso" class="mb-2">Curso:</label>
                            <select class="form-control" id="curso" name="curso" required>
                                <optgroup label="Cursos Disponíveis">
                                    <option value="DSM" {{ $edital->curso === 'DSM' ? 'selected' : '' }}>Tecnologia em Desenvolvimento de Software
                                        Multiplataforma</option>
                                    <option value="GTI" {{ $edital->curso === 'GTI' ? 'selected' : '' }}>Tecnologia em Gestão da Tecnologia da Informação</option>
                                    <option value="PI" {{ $edital->curso === 'PI' ? 'selected' : '' }}>Tecnologia em Gestão da Produção Industrial</option>
                                    <option value="GE" {{ $edital->curso === 'GE' ? 'selected' : '' }}>Tecnologia em Gestão Empresarial</option>
                                </optgroup>
                            </select>
                        </div>


                        <div class="form-group mt-2">
                            <label for="disciplina" class="mb-2">Nome da Disciplina:</label>
                            <input type="text" class="form-control" id="disciplina" name="disciplina"
                                placeholder="Ex: Programação Avançada" value="{{ $edital->disciplina }}" required>
                        </div>
                        <div class="form-group row">
                            <div class="col">
                                <p class="mt-3">
                                    <label for="turno">Turno:</label>
                                    <input type="radio" name="turno" id="noturno" value="Noturno" {{ $edital->turno === 'Noturno' ?'checked' : '' }}>
                                    <label for="noturno" >Noturno</label>
                                    <input type="radio" name="turno" id="diurno" value="Diurno" {{ $edital->turno === 'Diurno' ?'checked' : '' }}>
                                    <label for="diurno">Diurno</label>
                                </p>
                                <div class="form-group">
                                    <label for="horas_aula">Horas aula:</label>
                                    <input type="number" class="form-control" id="horas_aula" name="horas_aula"
                                        value="{{ $edital->horas_aula }}" min="0" required>
                                    <small>Informe o número de horas-aula.</small>
                                </div>
                            </div>
                        </div>


                        <div class="form-group mt-2">
                            <label for="dia_semana" class="mb-2">Dia da Semana:</label>
                            <select class="form-control" id="dia_semana" name="dia_da_semana" required>
                                <option value="">Selecione o dia da semana</option>
                                <option value="0" {{ $edital->dia_da_semana == 0 ? 'selected' : '' }}>Domingo</option>
                                <option value="1" {{ $edital->dia_da_semana == 1 ? 'selected' : '' }}>Segunda-feira</option>
                                <option value="2" {{ $edital->dia_da_semana == 2 ? 'selected' : '' }}>Terça-feira</option>
                                <option value="3" {{ $edital->dia_da_semana == 3 ? 'selected' : '' }}>Quarta-feira</option>
                                <option value="4" {{ $edital->dia_da_semana == 4 ? 'selected' : '' }}>Quinta-feira</option>
                                <option value="5" {{ $edital->dia_da_semana == 5 ? 'selected' : '' }}>Sexta-feira</option>
                                <option value="6" {{ $edital->dia_da_semana == 6 ? 'selected' : '' }}>Sábado</option>
                            </select>
                        </div>


                        <div class="form-group mt-2 row">
                            <label>Horário de Oferecimento:</label>

                            <div class="col date">
                                <p>Horário Início</p>
                                <input type="time" class="form-control" name="horario_inicio" value="{{ $edital->horario_inicio }}">
                            </div>

                            <div class="col date">
                                <p>Horário Fim</p>
                                <input type="time" class="form-control" name="horario_fim" value="{{ $edital->horario_fim }}">
                            </div>
                        </div>

                        <div class="form-group mt-2">
                            <label for="prazo" class="mb-2">Prazos:</label>
                            <input type="radio" id="prazo" name="prazo" value="determinado" {{ $edital->prazo == 'determinado' ? 'checked' : '' }}> Determinado
                            <input type="radio" id="prazo" name="prazo" value="indeterminado" {{ $edital->prazo == 'indeterminado' ? 'checked' : '' }}>
                            Indeterminado
                        </div>

                        <div class="form-group mt-2">
    <label for="status" class="mb-2">Status:</label>
    <select class="form-control" id="status" name="status" required>
        <option value="">Selecione um status</option>
        @foreach ($statusOptions as $key => $value)
            <option value="{{ $key }}" {{ $edital->status == $key ? 'selected' : '' }}>{{ $value }}</option>
        @endforeach
    </select>
</div>

                    </div>

                    <div class="card-footer row" class="mb-2">
                        <!-- <div class="col">
                            <label for="anexar-edital" class="mb-2">Anexar Edital:</label>
                            <input type="file" name="anexo_edital" id="anexar-edital" class="form-control labeled">
                            <small>Selecione o arquivo do edital para anexar (.pdf).</small>
                        </div> -->
                        <div class="col">
                            <p><input type="submit" value="Salvar Alterações" class="form-control btn btn-danger"></a>
                        </div>
                    </div>
            </div>
            </form>
        </div>
        </div>
    </main>
    <!-- FIM Main -->
@endsection
