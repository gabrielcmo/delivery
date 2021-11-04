@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        asdasd
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        asdasd
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        asdasd
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="col-md-12">
                <div class="card">
                    <div id="pie-chart"></div>
                </div>
            </div>
        </div>
        <div class="col-md-12 mt-2">
            <div class="card">
                <form method="get" id="form-periodo">

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="form-group mr-auto mt-4 row">
                        <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('De') }}</label>
                        <div class="col-md-3">
                            <input type="date" required max="{{ date('Y-m-d') }}" id="from" name="from" value="{{ date('Y-m-d') }}">
                        </div>
                        
                        <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('até') }}</label>
                        <div class="col-md-3">
                            <input type="date" required max="{{ date('Y-m-d') }}" id="to" name="to" value="{{ date('Y-m-d') }}">
                        </div>

                        <div class="col-md-2">
                            <button type="submit" class="btn btn-success" onClick="vendasPeriodo()">Selecionar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('#from').change(function(){
        $('#to').attr('min', document.getElementById('from').value);
    });

    function vendasPeriodo(){
        var from = document.getElementById('from').value;
        var to = document.getElementById('to').value;
        var route = "{{ route('selecionarVendasPeriodo') }}";
        var formData = $('#form-periodo').serializeArray();

        console.log(formData)

        console.log(from, to);
        $.ajax( {
            url: route,
            type: 'post',
            data: formData,
            dataType: 'json',
            success: function(result){
                swal({
                    text: "Produto adicionado ao carrinho",
                    icon: 'success',
                    type: "success",
                    buttons: false,
                    timer: 1500
                });
            }
        });
    }
</script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    var vendas = '<?php echo $vendas ?>';
    console.log(vendas);
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(lineChart);

    function lineChart() {
        var data = new google.visualization.arrayToDataTable($.parseJSON(vendas));
          var options = {
            'legend':'right',
            'title':'Vendas Por Categoria Dos Produtos',
            'is3D':true,
            'width':700,
            'height':400,
          };
        var chart = new google.visualization.PieChart(document.getElementById('pie-chart'));
        chart.draw(data, options);
    }        
</script>
@endsection
