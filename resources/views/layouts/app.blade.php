<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/bootstrap.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    @auth
        @php
            $user = Auth::user()->id;
            $carrinho = \Cart::session($user);
        @endphp
    @endauth
    
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark shadow-sm" style="background-color: #a01b1e;">
            <div class="container">
                <a class="navbar-brand mt-1" href="{{ url('/') }}">
                    <h4>{{ config('app.name') }}</h4>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Entrar') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Registrar') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="modal" data-target="#carrinhoModal" role="button" v-pre>
                                    <i class="fas fa-shopping-cart"></i>
                                    {{ \Cart::session(Auth::user()->id)->getTotalQuantity() }}
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    Olá, {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('editarPerfilView') }}">
                                        {{ __('Editar perfil') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Sair') }}
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
        <main class="py-4">
            @yield('content')
        </main>
        
        <!-- Carrinho Modal -->
        <div class="modal fade" id="carrinhoModal" tabindex="-1" role="dialog" aria-labelledby="carrinhoModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="carrinhoModalLabel">Carrinho</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @guest 
                        @php redirect()->route('login') @endphp
                    @else
                        @if ($carrinho->getTotalQuantity() == 0)
                            Você não tem nenhum item no carrinho ainda.
                        @else
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col">Nome</th>
                                    <th scope="col">Valor</th>
                                    <th scope="col">Quantidade</th>
                                    <th scope="col">Total</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($carrinho->getContent() as $item)
                                        <tr>
                                            <th scope="row"><img src="{{ $item->img }}" alt="Imagem produto {{$item->id}}" width="50px"></th>
                                            <td>{{$item->name}}</td>
                                            <td>{{$item->price}}</td>
                                            <td>{{$item->quantity}}</td>
                                            <td>{{$item->price*$item->quantity}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <a type="button" href="{{ route('limparCarrinho') }}" class="btn btn-danger">Limpar carrinho</a>
                            <button type="button" class="btn btn-success">Atualizar carrinho</button>
                        </div>
                        @endif
                    @endguest
                </div>
            </div>
        </div>
    </div>
</body>
</html>