@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        
        <div class="col-md-12 col-sm-12">
            <div class="card">
                <form class="form mt-3 mb-3 ml-4 mr-2" method="post" action="{{ route("selecionarVendasPeriodo") }}">
                    @csrf

                    <div class="form-row">
                        <div class="col-4 col-sm-5 col-md-4">
                            <div class="form-group">
                                <label for="from" class="mr-2">{{ __('De') }}</label>
                                <input type="date" class="form-control" required max="{{ date('Y-m-d') }}" id="from" name="from" value="@if(isset($from)){{$from}}@else{{date('Y-m-d')}}@endif">
                            </div>
                        </div>

                        <div class="col-4 col-sm-5 col-md-4">
                            <div class="form-group">
                                <label for="to" class="mr-2">{{ __('até') }}</label>
                                <input type="date" class="form-control" required min="@if(isset($from)){{$from}}@else{{date('Y-m-d')}}@endif" max="{{ date('Y-m-d') }}" id="to" name="to" value="@if(isset($to)){{$to}}@else{{date('Y-m-d')}}@endif">
                            </div>
                        </div>
                        
                        <div class="col" style="margin-top: 30px;">
                            <button class="btn btn-success" type="submit">Selecionar</button>
                        </div>
                    </div> 
                </form>
            </div>
        </div>
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-12 mt-3 mb-3">
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
            <div class="col-md-12 mt-3">
                <div class="card">
                    <div class="d-flex justify-content-center mt-3 m-2" id="pie-chart"></div>
                </div>
            </div>
            
            <div class="col-md-12  mt-3">
                <div class="card">
                    <div class="d-flex justify-content-center mt-3 m-2" id="bar-chart"></div>
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

    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(pieChart);
    google.charts.setOnLoadCallback(barChart);

    function barChart(){
        var data = new google.visualization.arrayToDataTable($.parseJSON(vendasPorMetodoPagamento));
        
        var options = {
            'legend':'bottom',
            'title':'Vendas Por Cada Método de Pagamento',
            'width':"auto",
            'height':"auto",
        };

        var chart = new google.visualization.BarChart(document.getElementById('bar-chart'));
        chart.draw(data, options);
    }

    function pieChart() {
        var data = new google.visualization.arrayToDataTable($.parseJSON(vendas));

          var options = {
            'legend':'right',
            'title':'Vendas Por Categoria Dos Produtos',
            'is3D':true,
            'width':"auto",
            'height':"auto",
          };
        var chart = new google.visualization.PieChart(document.getElementById('pie-chart'));
        chart.draw(data, options);
    }        
</script>
@endsection
