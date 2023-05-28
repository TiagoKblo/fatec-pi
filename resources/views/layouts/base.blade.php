<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal de Editais - Página Inicial</title>

    <!-- FavIcons -->
    <link rel="apple-touch-icon" sizes="180x180" href="/img/icons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/img/icons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/img/icons/favicon-16x16.png">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="/css/main.css">

    <!-- Scripts -->
    @vite(['resources/js/app.js'])
</head>
<body>
    @if (session()->has('success'))
        <div id="success-alert" class="alert alert-success alert-dismissible fade show text-center" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif


<!-- Cabeçalho Principal -->
    <header id="cabecalho">
        <section class="container d-flex align-items-center justify-content-between">
            <!-- Logo/Brand da FATEC -->
            <a class="logo" href="/"><img src="/img/logo_fatec/logo_fatec_cor.png" alt="Fatec Itapira"></a>

            <!-- Caixa de Pesquisa -->
            <div class="pesquisa d-flex align-content-center">
                <input type="search" class="caixa-pesquisa" placeholder="Pesquisar Cargos ou Fatecs">
                <button type="submit">Pesquisar</button>
            </div>

            <!-- Botões de Autenticação e Perfil -->
            <ul class="autenticar">
            @auth
                <li style="text-decoration: underline">
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?= strtok(Auth::user()->name, ' ') ?>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="/logout">Sair</a>
                        </div>
                    </div>
                </li>
            @else
                <li class="cadastrar"><a href="/register">Cadastre-se</a></li>
                <li class="login"><a href="/login">Login</a></li>
            @endauth
            </ul>
        </section>

        <!-- Filtros -->
        <section class="container">
            <div class="filtros d-flex justify-content-between">
                <select class="form-select btn">
                    <option>A Qualquer Momento</option>
                </select>

                <select class="form-select btn">
                    <option>Tipo de Vaga</option>
                </select>

                <select class="form-select btn">
                    <option>Setores</option>
                </select>

                <select class="form-select btn">
                    <option>Carga Horária</option>
                </select>
            </div>
        </section>
        <!-- FIM Filtros -->
    </header>
    <!-- FIM Cabeçalho Principal -->

    <!-- MAIN! -->
    @yield('main')

    <div class="voltar-topo">
        <a href="#principal"><img src="/img/seta-cima.png" alt="Voltar ao Topo"></a>
    </div>

    <!-- Rodapé Principal -->
    <footer id="rodape">
        <section class="cps-logo">
            <div class="container d-flex justify-content-center">
                <!-- CPS LOGO e Governo Estado de São Paulo -->
                <img src="/img/footer-cps-logo.png" alt="Centro Paula Souza e Governo do Estado de São Paulo">
            </div>
        </section>
        <p class="cps-copy d-flex justify-content-center">Copyright © 2022 Fatec Itapira - Todos os Direitos Reservados - Desenvolvido por Equipe do Projeto Integrador da Fatec</p>
    </footer>
    <!-- FIM Rodapé Principal -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script>
        let alert = document.getElementById('success-alert');
        let duration = 10000; // Adjust the duration (in milliseconds) as per your requirement

        setTimeout(() => {
            let bootstrapAlert = new bootstrap.Alert(alert);
            bootstrapAlert.close();
        }, duration);
    </script>
    @yield('scripts')
</body>
</html>
