@extends('layouts.app')

@section('content')
@php
    $user = Auth::user()->id;
    $carrinho = \Cart::session($user);
@endphp
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Carrinho') }}</div>

                <div class="card-body">
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
                <div class="card-footer d-flex justify-content-end">
                    <a type="button" href="{{ route('limparCarrinho') }}" class="btn btn-danger mr-2">Limpar carrinho</a>
                    <button type="button" class="btn btn-success">Fazer pedido</button>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection