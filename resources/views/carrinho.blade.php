@extends('layouts.app')

@section('content')
@php
    $user = Auth::user()->id;
    $carrinho = \Cart::session($user);
@endphp
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Carrinho') }}</div>

                <div class="card-body">
                    @if ($carrinho->getTotalQuantity() == 0)
                        Você não tem nenhum item no carrinho ainda.
                    @else
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
                                <form action="{{ route('checkoutPedido') }}" method="post">
                                    @csrf
                                    @foreach($carrinho->getContent() as $item)
                                        <tr class="text-center">
                                            <th scope="row"><img class="rounded" src="{{ asset("/imgs/{$item->associatedModel->img}") }}" alt="Imagem produto {{$item->id}}" width="50px"></th>
                                            <td>{{$item->name}}</td>
                                            <td>R${{$item->price}}</td>
                                            <td class="d-flex justify-content-center"><input class="form-control" style="width:60%;" step="1" type="number" min='1' max="{{ $item->associatedModel->qtd_estoque }}" name="qtd{{$item->associatedModel->id}}" id="qtd{{$item->associatedModel->id}}" value="{{$item->quantity}}" onChange="changeValue(@php echo $item->associatedModel->id @endphp)"></td>
                                            <td class="col-2"><div id="total{{$item->associatedModel->id}}">R${{$item->price*$item->quantity}}</div></td>
                                            <div id="estoque{{$item->associatedModel->id}}" hidden>{{ $item->associatedModel->qtd_estoque }}</div>
                                            <div id="price{{$item->associatedModel->id}}" hidden>{{$item->price}}</div>
                                        </tr>
                                    @endforeach
                            </tbody>
                        </table>
                </div>
                <div class="card-footer d-flex justify-content-end">
                    <a type="button" href="{{ route('limparCarrinho') }}" class="btn btn-danger mr-2">Limpar carrinho</a>
                    <button type="submit" class="btn btn-success">Fazer pedido</button>
                    </form>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
<script>
    function changeValue(id){
        var qtd = document.getElementById('qtd'+id)
        var price = document.getElementById('price'+id)
        var total = document.getElementById('total'+id)
        var qtd_estoque = document.getElementById('estoque'+id)

        if(qtd.value > parseFloat(qtd_estoque.innerHTML)){
            qtd.value = parseFloat(qtd_estoque.innerHTML)

            valorTotal = qtd.value*price.innerHTML
            valorTotalArrendondado = parseFloat(valorTotal.toFixed(2))

            total.innerHTML = 'R$'+valorTotalArrendondado
             
            alert('Temos apenas '+ qtd_estoque.innerHTML +' desse produto disponíveis.')
            return
        }

        if(qtd.value <= 0){
            qtd.value = 1
            total.innerHTML = 'R$'+price.innerHTML
            return
        }
        
        valorTotal = qtd.value*price.innerHTML
        valorTotalArrendondado = parseFloat(valorTotal.toFixed(2))

        total.innerHTML = 'R$'+valorTotalArrendondado
    }
</script>
@endsection