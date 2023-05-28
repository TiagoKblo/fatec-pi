@extends('layouts.base')

@section('main')
    <!-- Main -->
    <main id="principal">
        <h1 class="text-center">N° {{ $edital->numero_edital }}</h1>
        <div class="container">
            <div class="card">
                <div class="fatec-logo">
                    <img src="/img/fatec-itapira.png" alt="Fatec Itapira">
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $edital->disciplina }}</h5>
                    <p class="card-text"><small class="text-muted">Fatec Itapira - Edital Interno -
                            <time>{{ $edital->getDiaDaSemana() }}  {{ $edital->getHorarioInicio() }} às
                                {{ $edital->getHorarioFim() }}</time></small></p>
                    @foreach (explode("\n", $edital->descricao) as $descricao)
                        <p class="card-text">{{ $descricao }}</p>
                    @endforeach
                </div>

                <div class="card-footer d-flex justify-content-between">
                    <p class="card-text"><strong>Curso</strong> {{ $edital->curso }}</p><a href="edital.html"
                        class="btn btn-primary">Saiba Mais</a>
                </div>


                <div class="card-body">
                    <p class="card-text">Documentos Adicionados</p>
                    <p class="card-text">
                        <a href="/anexos/{{ $edital->anexo_edital }}" class="arquivo">
                            <span>{{ $edital->anexo_edital }}</span>
                        </a>
                    </p>
                </div>
            </div>
    </main>
    <!-- FIM Main -->
@endsection
