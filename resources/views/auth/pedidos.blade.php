@extends('layouts.app')

@section('content')
@php
    $user = Auth::user();
    $carrinho = \Cart::session($user->id);
@endphp
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Meus Pedidos') }}</div>

                <div class="card-body">
                    @if ($user->pedidos->count() == 0)
                        Você não realizou nenhum pedido ainda.
                    @else
                        <div id="accordion">
                            @foreach ($user->pedidos->sortByDesc('id') as $pedido)
                                <div class="card">
                                    <div class="card-header" id="heading{{$pedido->id}}">
                                        <h5 class="mb-0 row">
                                            <button class="col-12 btn btn-link text-decoration-none" data-toggle="collapse" data-target="#collapse{{$pedido->id}}" aria-expanded="true" aria-controls="collapse{{$pedido->id}}">
                                                <div class="float-left">
                                                    Pedido {{$pedido->id}}
                                                </div>
                                                
                                                <div class="float-right">
                                                    <strong>Valor total: R${{$pedido->valor}}</strong>
                                                </div>
                                            </button>
                                        </h5>
                                    </div>
                                
                                    <div id="collapse{{$pedido->id}}" class="collapse" aria-labelledby="heading{{$pedido->id}}" data-parent="#accordion">
                                        <div class="card-body">
                                            <table class="table">
                                                <thead>
                                                <tr class="text-center">
                                                    <th scope="col"></th>
                                                    <th scope="col">Produto</th>
                                                    <th scope="col">Valor</th>
                                                    <th scope="col" class="text-center">Quantidade</th>
                                                    <th scope="col">Total</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($pedido->produtos as $produto)
                                                        @php
                                                            $p = \App\Models\Produto::find($produto->produto_id);
                                                        @endphp
                                                        <tr class="text-center">
                                                            <th scope="row"><img class="rounded" src="{{ asset("/imgs/{$p->img}") }}" alt="Imagem produto {{$produto->id}}" width="50px"></th>
                                                            <td>{{$p->nome}}</td>
                                                            <td>R${{$produto->valor}}</td>
                                                            <td class="d-flex justify-content-center">{{$produto->qtd}}</td>
                                                            <td class="col-2">R${{$produto->valor*$produto->qtd}}</div></td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection