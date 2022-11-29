<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!--CSS da aplicação-->
    <link rel="stylesheet" href={{asset('/estilo/style.css')}}>
    <!--CSS bootstrap-->
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <!--Script-->
    <script src={{asset('/js/scripts.js')}}></script>
    <!--Flatpickr.js-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <!--Fontes-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Abyssinica+SIL&family=Roboto:wght@300&display=swap" rel="stylesheet"> 
    <link rel="shortcut icon" href="../public/img/favicon.ico" type="image/x-icon">

</head>
<body>
    <header>
        <a href="/"><img src="{{asset('/img/DP_DF-preto.png')}}" alt="logo-defensoria" height="59px" width="225px"></a>
        <nav class = 'menu'>
        <a href="/">Home</a>
        @auth
        <div class= 'menu'>
        <form method="POST" name="logout" action="{{ route('logout') }}">
        @csrf
        <a href="javascript:document.logout.submit()">Logout</a>
        </form>
        </div>
        <a href="{{ route('mediacao.agendamentos') }}">Meus atendimentos</a>
        @endauth
        @guest
        <a href="{{ route('login') }}">Login</a>
        <a href="{{ route('register') }}">Cadastrar</a>
        @endguest
        <a href="{{ route('calendario.get') }}">Calendario</a>
        </nav>
        
    </header>
        @yield('content')

    <footer class="fixed-bottom">
        <p>Produzido para a<a href="http://www.defensoria.df.gov.br/" target="_blank">Defensoria Pública - DF</a></p>
    </footer>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <!-- flatpickr -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://npmcdn.com/flatpickr/dist/flatpickr.min.js"></script>
        <!-- Mudar lingua do flatpickr -->
        <script src="https://npmcdn.com/flatpickr/dist/l10n/pt.js"></script>
            <script>
                flatpickr.localize(flatpickr.l10ns.pt)
                flatpickr('.flatpickr-input')
            </script>
        <script>
        config = {
            enableTime: true,
            dateFormat: "Y-m-d H:i",
            minDate: "today",
            time_24hr: true,
        }
        flatpickr("input[type=datetime]", config);
        flatpickr(myElement, {
    "locale": "pt_BR"  // locale for this instance only
    });
    </script>
    
</body>
</html>