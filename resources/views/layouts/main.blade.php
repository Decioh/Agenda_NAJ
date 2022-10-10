<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!--CSS da aplicação-->
    <link rel="stylesheet" href="/estilo/style.css">
    <!--CSS bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <!--Script-->
    <script src="/public/js/scripts.js"></script>
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
        <img src="/img/DP_DF-preto.png" alt="logo-defensoria" height="59px" width="225px">
        <nav class = 'menu'>
        <a href="/">Home</a>
        <a href="#">Login</a>
        <a href="#">Sobre</a>
        </nav>
    </header>
        @yield('content')
    <footer>
        <p>Produzido por <a href="https://github.com/Decioh" target="_blank">Décio Carretta</a>, para a <a href="http://www.defensoria.df.gov.br/" target="_blank">Defensoria Pública</a></p>
    </footer>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <!-- flatpickr -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        config = {
            enableTime: true,
            dateFormat: "Y-m-d H:i",
            minDate: "today",
            time_24hr: true,
        }
        flatpickr("input[type=datetime]", config);
    </script>
</body>
</html>