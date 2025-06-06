<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="Dionísio Neto">
        <meta name="description"  content="...">
        <title>@yield('title')</title>
        {{-- Icons do fontawesome --}}
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
            integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
            crossorigin="anonymous"
            referrerpolicy="no-referrer"
        />
        <link rel="shortcut icon" href="./imgs/docs-dark.svg" type="image/x-icon">
        {{-- CSS --}}
        <link rel="stylesheet" href="{{ asset('./styles/reset.css') }}">
        <link rel="stylesheet" href="{{ asset('./styles/header.css') }}">
        <link rel="stylesheet" href="{{ asset('./styles/sidbar.css') }}">
        <link rel="stylesheet" href="{{ asset('./styles/sidbar-right.css') }}">
        <link rel="stylesheet" href="{{ asset('./styles/responsive-nav.css') }}">
        {{-- Livewire styles  --}}
        @livewireStyles
        <!-- Estilos específicos da rota -->
        @if(request()->is('/'))
            <link rel="stylesheet" href="{{ asset('./styles/card.css') }}">
        @elseif(request()->is('support'))
            <link rel="stylesheet" href="{{ asset('./styles/support.css') }}">
        @elseif(request()->is('login'))
            <link rel="stylesheet" href="{{ asset('./styles/login.css') }}">
        @elseif(request()->is('perfil', 'usuario/*'))
            <link rel="stylesheet" href="{{ asset('./styles/card.css') }}">
            <link rel="stylesheet" href="{{ asset('./styles/perfil.css') }}">
        @elseif(request()->is('definicoes'))
            <link rel="stylesheet" href="{{ asset('./styles/definicao.css') }}">
        @elseif(request()->is('criar'))
            <link rel="stylesheet" href="{{ asset('./styles/criar.css') }}">
        @elseif(request()->is('Pesquisar'))
            <link rel="stylesheet" href="{{ asset('./styles/search.css') }}">
        @elseif(request()->is('guardados'))
            <link rel="stylesheet" href="{{ asset('./styles/guardados.css') }}">
        @elseif(request()->is('audios', 'videos', 'imagens', 'livros-pdfs'))
            <link rel="stylesheet" href="{{ asset('./styles/card.css') }}">
        @endif
</head>
<body>
    @yield('content')
    @livewireScripts
    @stack('scripts')
    <script src="{{ asset('./js/script.js') }}"></script>
</body>
</html>
