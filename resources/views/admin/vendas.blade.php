@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        
        <div class="col-md-12 mt-2 mb-4">
            <div class="card">
                <form method="post" action="{{ route("selecionarVendasPeriodo") }}">
                    @csrf

                    <div class="form-group mr-auto mt-4 row">
                        <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('De') }}</label>
                        <div class="col-md-3">
                            <input type="date" required max="{{ date('Y-m-d') }}" id="from" name="from" value="@if(isset($from)){{$from}}@else{{date('Y-m-d')}}@endif">
                        </div>
                        
                        <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('até') }}</label>
                        <div class="col-md-3">
                            <input type="date" required min="@if(isset($from)){{$from}}@else{{date('Y-m-d')}}@endif" max="{{ date('Y-m-d') }}" id="to" name="to" value="@if(isset($to)){{$to}}@else{{date('Y-m-d')}}@endif">
                        </div>

                        <div class="col-md-2">
                            <button type="submit" class="btn btn-success" onClick="vendasPeriodo()">Selecionar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-12 mb-3">
                    <div class="card">
                        <div class="card-header">Top 5 Produtos Mais Vendidos</div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr class="text-center">
                                        <th scope="col">Posição</th>
                                        <th scope="col">Produto</th>
                                        <th scope="col">Qtd Vendas</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($top_5_vendidos as $key => $item)
                                    @php $produto = \App\Models\Produto::find($item->produto_id); @endphp
                                            <tr class="text-center">
                                                <td>{{++$key}}°</td>
                                                <td>{{$produto->nome}}</td>
                                                <td>{{$item->total}}</td>
                                            </tr>
                                        @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <strong>Total vendido: </strong>R${{ $total_vendido }} <br>
                            <strong>Total pedidos feitos: </strong>{{ $qtd_pedidos_feitos }}
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mt-3">
                    <div class="card">
                        <div class="card-body">
                            <strong>Cliente que mais fez pedidos: </strong>{{ $cliente_fiel["email"] }} <br>
                            <strong>Pedidos feitos: </strong>{{ $cliente_fiel["total_pedidos"] }} <br>
                            <strong>Total gasto: </strong>R${{ $cliente_fiel["total_comprado"] }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="col-md-12">
                <div class="card">
                    <div class="d-flex justify-content-center" id="pie-chart"></div>
                </div>
            </div>
            
            <div class="col-md-12 mt-3">
                <div class="card">
                    <div id="bar-chart"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('#from').change(function(){
        $('#to').attr('min', document.getElementById('from').value);
    });
</script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">

    var vendas = '<?php echo $vendas ?>';
    var vendasPorMetodoPagamento = '<?php echo $vendasPorMetodoPagamento ?>';

    console.log(vendas);
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(pieChart);
    google.charts.setOnLoadCallback(barChart);

    function barChart(){
        var data = new google.visualization.arrayToDataTable($.parseJSON(vendasPorMetodoPagamento));
          var options = {
            'legend':'right',
            'title':'Vendas Por Cada Método de Pagamento',
            'is3D':false,
            'width':600,
            'height':400,
          };
        var chart = new google.visualization.BarChart(document.getElementById('bar-chart'));
        chart.draw(data, options);
    }

    function pieChart() {
        var data = new google.visualization.arrayToDataTable($.parseJSON(vendas));
          var options = {
            'legend':'right',
            'title':'Vendas Por Categoria Dos Produtos',
            'is3D':false,
            'width':600,
            'height':400,
          };
        var chart = new google.visualization.PieChart(document.getElementById('pie-chart'));
        chart.draw(data, options);
    }        
</script>
@endsection
