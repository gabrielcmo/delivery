@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Produtos') }}</div>

                <div class="card-body">
                    <table class="table">
                        <thead id="thead-carrinho">
                            <tr class="text-center">
                                <th scope="col">ID</th>
                                <th scope="col">Nome</th>
                                <th scope="col">Descrição</th>
                                <th scope="col">Qtd. Estoque</th>
                                <th scope="col">Valor</th>
                                <th scope="col">Ações</th>
                            </tr>
                        </thead>
                        <tbody id="tbody-carrinho">
                            @foreach($produtos as $produto)
                                <tr class="text-center">
                                    <td>{{$produto->id}}</td>
                                    <td>{{$produto->nome}}</td>
                                    <td>{{$produto->descricao}}</td>
                                    <td>{{$produto->qtd_estoque}}</td>
                                    <td>R${{$produto->valor}}</td>
                                    <td>
                                        <a href=""><i class="fas fa-edit"></i></a>
                                        <a class="text-danger" href=""><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
