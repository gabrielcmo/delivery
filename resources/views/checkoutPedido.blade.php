@extends('layouts.app')

@section('content')
@php
    $user = Auth::user();
    $carrinho = \Cart::session($user->id);
@endphp
<style>
    #thead-carrinho {
        font-size: 85%;
    }

    #tbody-carrinho {
        font-size: 75%;
    }

    #card-footer-carrinho {
        font-size: 85%;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-md-12 mb-2">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Cardápio</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('viewCarrinho') }}">Carrinho</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Pedido</li>
                </ol>
            </nav>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Endereço') }}</div>

                <div class="card-body">
                    @if ($user->endereco == null)
                        <a type="button" href="{{ route('editarPerfilView') }}" class="btn btn-success mr-2">Adicionar endereço de entrega</a>
                    @else
                        <a type="button" href="{{ route('editarPerfilView') }}" class="btn btn-success col-md-4 mb-3">Atualizar endereço de entrega</a>
                        <table class="table">
                            <thead>
                                <tr class="text-center">
                                    {{-- <th scope="col"></th> --}}
                                    <th scope="col">Rua</th>
                                    <th scope="col">Número</th>
                                    <th scope="col">Bairro</th>
                                    <th scope="col">Cidade</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="text-center">
                                    <td>{{$user->endereco->rua}}</td>
                                    <td>{{$user->endereco->numero}}</td>
                                    <td>{{$user->endereco->bairro}}</td>
                                    <td>{{$user->endereco->cidade}}</td>
                                </tr>
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
            
            <div class="card mb-4 mt-4">
                <div class="card-header">{{ __('Método de Pagamento') }}</div>

                <div class="card-body">
                    <form id="MetodoDePagamento" action="{{ route('endCheckoutPedido') }}" method="get">
                        <div class="form-group row mr-auto">
                            <label class="col-md-6 col-form-label text-md-right" for="metodoPagamento">Selecione um Método de Pagamento</label>
                            <div class="col-md-6">
                                <select name="metodoPagamento" required class="custom-select" id="metodoPagamento">
                                    <option value="1">Dinheiro</option>
                                    <option value="2">Cartão de Crédito</option>
                                    <option value="3">Cartão de Débito</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        
        <div class="col-md-4 justify-content-end">
            <div class="card">
                <div class="card-header">{{ __('Carrinho') }}</div>

                <div class="card-body">
                    <table class="table">
                        <thead id="thead-carrinho">
                            <tr class="text-center">
                                <th scope="col">Produto</th>
                                <th scope="col">Valor</th>
                                <th scope="col" class="text-center">Quantidade</th>
                                <th scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody id="tbody-carrinho">
                                @foreach($carrinho->getContent() as $item)
                                    <tr class="text-center">
                                        <td>{{$item->name}}</td>
                                        <td>R${{$item->price}}</td>
                                        <td>{{$item->quantity}}</td>
                                        <td>R${{ number_format($item->price*$item->quantity, 2) }}</td>
                                    </tr>
                                @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer" id="card-footer-carrinho">
                    <div class="d-flex justify-content-end">Sub total: &nbsp; R${{$carrinho->getTotal()}}</div>
                    <div class="d-flex justify-content-end">Taxa de entrega: &nbsp; R$4,00</div>
                    <strong class="d-flex justify-content-end">Total: &nbsp; R${{$carrinho->getTotal() + 4}}</strong>
                </div>
            </div>
        </div>
        
        <div class="col-md-12 mt-3 d-flex justify-content-end align-self-end">
            <button type="submit" form="MetodoDePagamento" class="btn btn-success">Finalizar pedido</button>
        </div>
    </div>
</div>
@endsection