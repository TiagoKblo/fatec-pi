@extends('layouts.base')

@section('main')
    <!-- Main -->
    <main id="principal">
        <h1 class="text-center">Editais Abertos</h1>
        <div class="container">
            @foreach ($editais as $edital)
                <div class="card">
                    <div class="fatec-logo">
                        <img src="/img/fatec-itapira.png" alt="Fatec Itapira">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $edital->disciplina }}</h5>
                        <p class="card-text"><small class="text-muted">Fatec Itapira - Edital Interno -
                                <time>{{ $semana[$edital->dia_da_semana] }} {{ $edital->horario_inicio }} às
                                    {{ $edital->horario_fim }}</time></small></p>
                        <p class="card-text">Saber da importância dos estoques nas empresas e como sua eficiência pode
                            impactar no lucro da organização. Desenvolver as habilidades de tomada de decisão na gestão dos
                            recursos materiais.</p>
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <p class="card-text"><strong>Curso</strong> {{ $edital->curso }}</p><a
                            href="{{ route('editais.show', $edital->id) }}" class="btn btn-primary">Saiba Mais</a>
                    </div>
                </div>
            @endforeach
        </div>
    </main>
    <!-- FIM Main -->
@endsection
