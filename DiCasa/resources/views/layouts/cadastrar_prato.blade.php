<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <title>@yield('titulo')</title>
    <link rel="stylesheet" href="{{ asset('css\cadastrar_prato.css') }}">
</head>
@csrf

<body>
    <div class="conteudo">
        <div class="cabecalho">@include('layouts.navigation')</div>
        @yield('conteudo')
        @yield('scripts')
    </div>
</body>
    