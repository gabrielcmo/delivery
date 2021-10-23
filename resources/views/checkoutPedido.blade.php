@extends('layouts.app')

@section('content')
@php
    $user = Auth::user()->id;
    $carrinho = \Cart::session($user);
@endphp
<div class="container">
    <div class="row justify-content-end">
        <div class="col-md-6">

        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('Carrinho') }}</div>

                <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr class="text-center">
                                {{-- <th scope="col"></th> --}}
                                <th scope="col">Produto</th>
                                <th scope="col">Valor</th>
                                <th scope="col" class="text-center">Quantidade</th>
                                <th scope="col">Total</th>
                            </tr>
                            </thead>
                            <tbody>
                                    @foreach($carrinho->getContent() as $item)
                                        <tr class="text-center">
                                            {{-- <th scope="row"><img class="rounded" src="{{ asset("/imgs/{$item->associatedModel->img}") }}" alt="Imagem produto {{$item->id}}" width="50px"></th> --}}
                                            <td>{{$item->name}}</td>
                                            <td>R${{$item->price}}</td>
                                            <td>{{$item->quantity}}</td>
                                            <td>R${{ number_format($item->price*$item->quantity, 2) }}</td>
                                        </tr>
                                    @endforeach
                            </tbody>
                        </table>
                </div>
                <div class="card-footer d-flex justify-content-end">
                    <strong>Total: &nbsp; R${{$carrinho->getTotal()}}</strong>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection