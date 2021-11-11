@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Clientes') }}</div>

                <div class="card-body" style="overflow-x: auto;">
                    <table class="table">
                        <thead id="thead-carrinho">
                            <tr class="text-center">
                                <th scope="col">ID</th>
                                <th scope="col">Nome</th>
                                <th scope="col">Email</th>
                                <th scope="col">Endereço</th>
                                <th scope="col">Ações</th>
                            </tr>
                        </thead>
                        <tbody id="tbody-carrinho">
                            @foreach($clientes as $cliente)
                                <tr class="text-center">
                                    <td>{{$cliente->id}}</td>
                                    <td>{{$cliente->name}}</td>
                                    <td>{{$cliente->email}}</td>
                                    <td>
                                        @php $end = $cliente->endereco; @endphp
                                        @if($end !== null)
                                            {{ $end->rua }}, {{$end->numero}}. {{$end->bairro}}. {{$end->cidade}}.
                                        @else
                                            <div class="text-danger">Não há endereço cadastrado.</div>
                                        @endif
                                    </td>
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
