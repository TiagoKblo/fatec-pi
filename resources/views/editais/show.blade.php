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
                            <time>{{ $semana[$edital->dia_da_semana] }} {{ $edital->horario_inicio }} às
                                {{ $edital->horario_fim }}</time></small></p>
                    <p class="card-text">Saber da importância dos estoques nas empresas e como sua eficiência pode impactar
                        no lucro da organização. Desenvolver as habilidades de tomada de decisão na gestão dos recursos
                        materiais.</p>
                </div>

                <div class="card-footer d-flex justify-content-between">
                    <p class="card-text"><strong>Curso</strong> {{ $edital->curso }}</p><a href="edital.html"
                        class="btn btn-primary">Saiba Mais</a>
                </div>


                <div class="card-body">
                    <p class="card-text">
                        <strong>EDITAL INTERNO Nº EI 24-2/2022 DE OFERECIMENTO DE AULAS, POR TEMPO INDETERMINADO, PARA A
                            FACULDADE DE TECNOLOGIA DE ITAPIRA “OGARI DE CASTRO PACHECO”, DO CENTRO ESTADUAL DE EDUCAÇÃO
                            TECNOLÓGICA PAULA SOUZA.</strong> O Diretor da Faculdade de Tecnologia de Itapira “Ogari de
                        Castro Pacheco”, com fundamento na DELIBERAÇÃO CEETEPS 48, DE 13-12-2018, com texto alterado pela
                        Deliberação 52 de 09-05-2019 - Consolidada em 09-05-2019, Instrução CESU 6/2022, Portaria CESU
                        01/2017, editais em vigor para concurso público docente e a legislação do Conselho Estadual de
                        Educação, faz saber ao corpo docente da Fatec contratado por tempo indeterminado, que está
                        disponível para ampliação de carga horária, por tempo indeterminado, a partir de do 2º semestre de
                        2022 (27/07/2022), a seguinte disciplina, da área ADMINISTRAÇÃO E NEGÓCIOS / ENGENHARIA E TECNOLOGIA
                        DE PRODUÇÃO (Versão 2.14.0 – 30/05/2022 da Tabela de Áreas e Disciplinas), pertencente a estrutura
                        curricular do Curso Superior de Tecnologia em Gestão da Produção Industrial, sendo ela DISCIPLINAS
                        DE FORMAÇÃO PROFISSIONALIZANTE em virtude do Declínio do Prof. Diego Nogueira Rafael em 06/06/2022 e
                        sem possibilidade de atribuição excepcional, com pagamento acima das 200h mensais, nos termos do
                        Comunicado GDS de 07 de abril de 2022.
                    </p>
                    <p class="card-text">
                        <strong>Gestão de Estoques – ADMINISTRAÇÃO E NEGÓCIOS / ENGENHARIA E TECNOLOGIA DE PRODUÇÃO - 2
                            horas-aula – turno Noturno – Segunda-feira das 19h00 às 20h40 </strong>
                    </p>
                    <p class="card-text">
                        Objetivo da disciplina: Saber da importância dos estoques nas empresas e como sua eficiência pode
                        impactar no lucro da organização. Desenvolver as habilidades de tomada de decisão na gestão dos
                        recursos materiais. Ementa da disciplina: O papel dos estoques na empresa; tipos de estoque; custo
                        dos estoques (cálculo de lote econômico); classificação ABC dos estoques; Negociações em sistemas de
                        suprimento organizacional; estoques de segurança; Nível de serviço e sua influência nos estoques;
                        sistemas de controle dos estoques. 1. CONDIÇÕES PARA ASSUMIR AS AULAS: Estarão aptos para ampliação
                        da referida disciplina, os docentes admitidos/contratados por tempo indeterminado, desde que sejam
                        atendidas as exigências previstas no artigo 3º da Deliberação CEETEPS 52/2019, na Instrução CESU
                        6/2022, conforme as exigências previstas para concurso público docente: DISCIPLINAS DE FORMAÇÃO
                        PROFISSIONALIZANTE 1. Graduação e titulação em programas de mestrado ou doutorado reconhecidos ou
                        recomendados na forma da lei, sendo a graduação ou a titulação na área da disciplina, e possuir
                        experiência profissional relevante de pelo menos 03 anos na área da disciplina; ou 2. Graduação e
                        especialização, cumulativamente, na área da disciplina e possuir experiência profissional relevante
                        de pelo menos 05 anos na área da disciplina.
                    </p>

                    <p class="card-text">Documentos Adicionados</p>
                    <p class="card-text">
                        <button class="arquivo">
                            <a href="/anexos/{{ $edital->anexo_edital }}">{{ $edital->anexo_edital }}</a>
                        </button>
                    </p>
                </div>
            </div>
    </main>
    <!-- FIM Main -->
@endsection
