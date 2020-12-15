<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>

    @php
        use App\Models\User;
    @endphp

    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-primary">
            <div class="container">
                <a class="navbar-brand" href="{{ route('home') }}">
                    {{ config('app.name', 'SmartOS') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        @guest 
                        @else 
                            {{-- Cliente --}}
                            @can('gerenciar clientes')
                                <li class="nav-item ">
                                    <a class="nav-link text-light" href="{{ route('cliente.index') }}" role="button" >
                                        <i class="fas fa-users"></i>&nbsp;Cliente
                                    </a>
                                </li>
                            @endcan
                            {{-- Celular --}}
                            @can('gerenciar celulares')
                                <li class="nav-item ">
                                    <a class="nav-link text-light" href="{{ route('celular.index') }}" role="button" >
                                        <i class="fas fa-mobile-alt"></i>&nbsp;Celular
                                    </a>
                                </li>
                            @endcan
                            {{-- Orçamento --}}
                            @can('gerenciar orcamento')
                                <li class="nav-item ">
                                    <a class="nav-link text-light" href="{{ route('orcamento.index') }}">
                                        <i class="fas fa-coins"></i>&nbsp;Orçamento
                                    </a>
                                </li>
                            @elsecan('informar orcamento')
                                <li class="nav-item ">
                                    <a class="nav-link text-light" href="{{ route('orcamento.index') }}">
                                        <i class="fas fa-coins"></i>&nbsp;Orçamento
                                    </a>
                                </li>
                            @endcan
                            {{-- Ordem de servico --}}
                            @can('consultar os')
                                <li class="nav-item ">
                                    <a class="nav-link text-light" href="{{ route('ordemservico.index') }}" role="button" >
                                        <i class="fas fa-clipboard-list"></i>&nbsp;Ordem de serviço
                                    </a>
                                </li>
                            @endcan
                            {{-- Peca --}}
                            @can('gerenciar pecas')
                                <li class="nav-item ">
                                    <a class="nav-link text-light" href="{{ route('peca.index') }}">
                                        <i class="fas fa-tools"></i>&nbsp;Peça
                                    </a>
                                </li>
                            @endcan
                        @endguest
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link text-light" href="{{ route('login') }}"><i class="fas fa-key"></i>   {{ __('Login') }}</a>
                                </li>
                            @endif
                            {{-- @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif --}}
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                   <i class="fas fa-user"></i> &nbsp; {{ Auth::user()->name }} ( {{ User::with('roles')->where('id', Auth::user()->id)->first()->roles[0]->name }} )
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <span><i class="fas fa-door-open"></i>&nbsp; Sair</span>
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="title">
                    @yield('message')
                </div>
            </div>
        </div>
        <main class="py-4">
            
            @yield('content')
        </main>

        <script src="{{ asset('js/app.js') }}"></script>
        @stack('javascript')
    </div>
</body>
</html>
