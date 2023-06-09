@extends('layouts.base')

@section('main')
    <!-- Main -->
    <main id="principal">
        <h1 class="text-center">Editais Abertos</h1>
        <div class="container">
            @if (count($editais) == 0)
                <div class="alert alert-warning" role="alert">
                    Não há editais abertos no momento.
                </div>
            @endif
            @foreach ($editais as $edital)
                <div class="card w-75">
                    <div class="fatec-logo">
                        <img src="/img/fatec-itapira.png" alt="Fatec Itapira">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $edital->disciplina }}</h5>
                        <p class="card-text"><small class="text-muted">Fatec Itapira - Edital Interno -
                                <time>{{ $edital->getDiaDaSemana() }}  {{ $edital->getHorarioInicio() }} às
                                    {{ $edital->getHorarioFim() }}</time></small></p>
                        <p class="card-text">Saber da importância dos estoques nas empresas e como sua eficiência pode
                            impactar no lucro da organização. Desenvolver as habilidades de tomada de decisão na gestão dos
                            recursos materiais.</p>
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <p class="card-text">
                            <strong>Curso</strong> {{ $edital->curso }}
                            <strong>Status</strong> {{ $edital->status === 'A' ? 'Aberto' : ($edital->status == 'F' ? 'Finalizado' : 'Cancelado') }}
                        </p>
                        <a href="{{ route('editais.show', $edital->id) }}" class="btn btn-primary">Saiba Mais</a>
                    </div>
                </div>
            @endforeach
        </div>
    </main>
    <!-- FIM Main -->
@endsection
