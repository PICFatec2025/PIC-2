<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo')</title>
    <link rel="stylesheet" href="{{ asset('css/style-vendas.css') }}">
    @vite('resources/css/app.css')
</head>
<body>

@yield('conteudo')

<script src="{{ asset('js/script.js') }}"></script>
</body>
</html>

