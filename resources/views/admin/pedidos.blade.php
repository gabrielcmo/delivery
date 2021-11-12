@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 col-sm-12">
            @php
                $pedidos = \App\Models\Pedido::where('status_id', 1)->get()->sortByDesc('id')->all();
                $pedidos_a_fazer = \App\Models\Pedido::where('status_id', 2)->get()->sortByDesc('id')->all();
                $pedidos_a_entregar = \App\Models\Pedido::where('status_id', 3)->get()->sortByDesc('id')->all();
                $pedidos_entregues = \App\Models\Pedido::where('status_id', 4)->get()->sortByDesc('id')->all();
                $pedidos_cancelados = \App\Models\Pedido::where('status_id', 5)->get()->sortByDesc('id')->all();
            @endphp

            @if (count($pedidos_cancelados) !== 0)
                <div class="card mb-3">
                    <div class="card-header bg-secondary"><strong class="text-white">{{ __('Pedidos cancelados') }}</strong></div>

                    <div class="card-body">
                        <div id="accordion">
                            @foreach ($pedidos_a_entregar as $pedido)
                                <div class="card mb-3">
                                    <div class="card-header" id="heading{{$pedido->id}}">
                                        <h5 class="mb-0 row">
                                            <button class="col-12 btn btn-link text-decoration-none" style="color: black;" data-toggle="collapse" data-target="#collapse{{$pedido->id}}" aria-expanded="true" aria-controls="collapse{{$pedido->id}}">
                                                <div class="float-left d-flex mb-2">
                                                    <div class="mr-5">Pedido #{{$pedido->id}}</div>
                                                    
                                                    <div class="mr-4">Cliente: {{$pedido->user->email}}</div>
                                                    <div class="mr-4">Método de Pagamento: {{$pedido->metodo_pagamento->nome}}</div>
                                                    <div class="mr-4">Valor total: R${{$pedido->valor}}</div>
                                                    @if (isset($tempo_estimado_entrega))
                                                        <div class="mr-1">Tempo de entrega: aproximadamente {{$tempo_estimado_entrega}} minutos</div>
                                                    @endif
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
                    </div>
                </div>
            @endif
            
            @if (count($pedidos_entregues) !== 0)
                <div class="card mb-3">
                    <div class="card-header bg-success"><strong>{{ __('Pedidos entregues') }}</strong></div>

                    <div class="card-body">
                        <div id="accordion">
                            @foreach ($pedidos_entregues as $pedido)
                                <div class="card mb-3">
                                    <div class="card-header" id="heading{{$pedido->id}}">
                                        <h5 class="mb-0 row">
                                            <button class="col-12 btn btn-link text-decoration-none" style="color: black;" data-toggle="collapse" data-target="#collapse{{$pedido->id}}" aria-expanded="true" aria-controls="collapse{{$pedido->id}}">
                                                <div class="float-left d-flex mb-2">
                                                    <div class="mr-5">Pedido #{{$pedido->id}}</div>
                                                    
                                                    <div class="mr-4">Cliente: {{$pedido->user->email}}</div>
                                                    <div class="mr-4">Método de Pagamento: {{$pedido->metodo_pagamento->nome}}</div>
                                                    <div class="mr-4">Valor total: R${{$pedido->valor}}</div>
                                                    @if (isset($tempo_estimado_entrega))
                                                        <div class="mr-1">Tempo de entrega: aproximadamente {{$tempo_estimado_entrega}} minutos</div>
                                                    @endif
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
                    </div>
                </div>
            @endif

            @if (count($pedidos_a_entregar) !== 0)
                <div class="card mb-3">
                    <div class="card-header bg-danger"><strong class="text-white">{{ __('Pedidos a entregar') }}</strong></div>

                    <div class="card-body">
                        <div id="accordion">
                            @foreach ($pedidos_a_entregar as $pedido)
                                <div class="card mb-3">
                                    <div class="card-header" id="heading{{$pedido->id}}">
                                        <h5 class="mb-0 row">
                                            <button class="col-12 btn btn-link text-decoration-none" style="color: black;" data-toggle="collapse" data-target="#collapse{{$pedido->id}}" aria-expanded="true" aria-controls="collapse{{$pedido->id}}">
                                                <div class="float-left d-flex mb-2">
                                                    <div class="mr-5">Pedido #{{$pedido->id}}</div>
                                                    
                                                    <div class="mr-4">Cliente: {{$pedido->user->email}}</div>
                                                    @php
                                                        // Atribuindo à variável 'end' o endereço do usuário, para diminuir o código.
                                                        $end = $pedido->user->endereco;
                                                    @endphp
                                                    <div class="mr-4 font-weight-bold">Endereço: {{$end->rua}}, {{$end->numero}}. {{$end->bairro}}. {{$end->cidade}}. @if($end->observacao !== null) Observação. {{$end->observacao}} @endif</div>
                                                    <div class="mr-4">Método de Pagamento: {{$pedido->metodo_pagamento->nome}}</div>
                                                    <div class="mr-4">Valor total: R${{$pedido->valor}}</div>
                                                    @if (isset($tempo_estimado_entrega))
                                                        <div class="mr-1">Tempo de entrega: aproximadamente {{$tempo_estimado_entrega}} minutos</div>
                                                    @endif
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
                                        <div class="card-footer">
                                            <a class="float-right btn btn-success mr-1 mb-3" href="{{route('pedidoEntregue', $pedido->id)}}">Pedido entregue</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            @if (count($pedidos_a_fazer) !== 0)
                <div class="card mb-3">
                    <div class="card-header bg-warning"><strong>{{ __('Pedidos a fazer') }}</strong></div>

                    <div class="card-body">
                        <div id="accordion">
                            @foreach ($pedidos_a_fazer as $pedido)
                                <div class="card mb-3">
                                    <div class="card-header" id="heading{{$pedido->id}}">
                                        <h5 class="mb-0 row">
                                            <button class="col-12 btn btn-link text-decoration-none" style="color: black;" data-toggle="collapse" data-target="#collapse{{$pedido->id}}" aria-expanded="true" aria-controls="collapse{{$pedido->id}}">
                                                <div class="float-left d-flex mb-2">
                                                    <div class="mr-5">Pedido #{{$pedido->id}}</div>
                                                    
                                                    <div class="mr-4">Cliente: {{$pedido->user->email}}</div>
                                                    <div class="mr-4">Método de Pagamento: {{$pedido->metodo_pagamento->nome}}</div>
                                                    <div class="mr-4">Valor total: R${{$pedido->valor}}</div>
                                                    @if (isset($tempo_estimado_entrega))
                                                        <div class="mr-1">Tempo de entrega: aproximadamente {{$tempo_estimado_entrega}} minutos</div>
                                                    @endif
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
                                        <div class="card-footer">
                                            <a class="float-right btn btn-success mr-1 mb-3" href="{{route('aEntregar', $pedido->id)}}">Saiu para entrega</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
            

            <div class="card">
                <div class="card-header bg-info"><strong>{{ __('Pedidos aguardando aprovação') }}</strong></div>

                <div class="card-body">
                    @if (count($pedidos) == 0)
                        <h4>Ainda não há nenhum pedido</h4>
                    @else
                        <div id="accordion">
                            @foreach ($pedidos as $pedido)
                                <div class="card mb-3">
                                    <div class="card-header" id="heading{{$pedido->id}}">
                                        <h5 class="mb-0 row">
                                            <button class="col-12 btn btn-link text-decoration-none" style="color: black;" data-toggle="collapse" data-target="#collapse{{$pedido->id}}" aria-expanded="true" aria-controls="collapse{{$pedido->id}}">
                                                <div class="float-left d-flex mb-2">
                                                    <div class="mr-5">Pedido #{{$pedido->id}}</div>
                                                    
                                                    <div class="mr-4">Cliente: {{$pedido->user->email}}</div>
                                                    <div class="mr-4">Método de Pagamento: {{$pedido->metodo_pagamento->nome}}</div>
                                                    <div class="mr-4">Valor total: R${{$pedido->valor}}</div>
                                                    @if (isset($tempo_estimado_entrega))
                                                        <div class="mr-1">Tempo de entrega: aproximadamente {{$tempo_estimado_entrega}} minutos</div>
                                                    @endif
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
                                        <div class="card-footer">
                                            <a class="float-right btn btn-success mr-1 mb-3" href="{{route('aceitarPedido', $pedido->id)}}">Aceitar pedido</a>
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