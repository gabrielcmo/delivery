@extends('layouts.app')

@section('content')
@php
    $user = Auth::user();
    $carrinho = \Cart::session($user->id);
@endphp
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 col-sm-12">
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
                                            <button class="col-12 btn btn-link text-decoration-none" style="color: black;" data-toggle="collapse" data-target="#collapse{{$pedido->id}}" aria-expanded="true" aria-controls="collapse{{$pedido->id}}">
                                                <div class="float-left mb-2">
                                                    Pedido {{$pedido->id}}
                                                </div>
    
                                                <div class="float-right d-flex">
                                                    @if (isset($tempo_estimado_entrega))
                                                        <div class="mr-3">Tempo de entrega: aproximadamente {{$tempo_estimado_entrega}} minutos</div>
                                                    @endif
                                                    <div class="mr-3 d-flex">
                                                        Status:&nbsp;<div class="@if($pedido->status->id == 1) text-info
                                                            @elseif($pedido->status->id == 2 || $pedido->status->id == 3 || $pedido->status->id == 4) text-success
                                                            @else text-danger @endif">{{$pedido->status->nome}}</div>
                                                    </div>
                                                    <div class="mr-3">Método de Pagamento: {{$pedido->metodo_pagamento->nome}}</div>
                                                    <div>Valor total: R${{$pedido->valor}}</div>
                                                </div>
                                            </button>
                                        </h5>
                                    </div>
                                
                                    <div id="collapse{{$pedido->id}}" class="collapse" aria-labelledby="heading{{$pedido->id}}" data-parent="#accordion">
                                        <div class="card-body" style="overflow-x:auto;">
                                            <table class="table" style="">
                                                <thead>
                                                <tr class="text-center">
                                                    <th scope="col"></th>
                                                    <th scope="col">Produto</th>
                                                    <th scope="col">Valor</th>
                                                    <th scope="col" class="text-center">Qtd</th>
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