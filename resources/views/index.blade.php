@extends('layouts.app')

@section('content')
<style>
    .card-produto {
        /* display: block; */
        position: relative;
        border-radius: 4px;
        text-decoration: none;
        z-index: 0;
        overflow: hidden;
        border: 1.8px solid #e0cece;
        transition: 0.3s;
    }

    .cart-button:hover {
        transition: all 0.25s ease-out;
        box-shadow: 1px 3px 5px rgba(19, 19, 19, 0.2);
        top: -1.5px;
        border: 1.8px solid #444343;
        background-color: #0c9207;
    }

    .nav-tabs > li > a.active{
        background-color: white !important;
        border-bottom: 1px solid white !important;
    }
</style>
<div class="container-fluid">
    <div class="d-flex justify-content-center mt-4 mb-5">
        <img class="img-thumbnail" src="{{ asset('/imgs/logo.jpg') }}" width="250px" alt="">
    </div>
    <div class="d-flex justify-content-center mt-4 mb-4">
        <h1>Cardápio</h1>
    </div>
    <div class="row justify-content-center">
        <div class="col-10">
            <div class="card mb-4">
                <div class="card-header">
                    <ul class="nav nav-tabs dark card-header-tabs">
                        @php $categorias = App\Models\CategoriaProduto::all() @endphp

                        @foreach ($categorias as $item_categoria)
                            <li class="nav-item">
                                <a class="nav-link @if($item_categoria->id == 1) active @endif" href="#tab{{ $item_categoria->id }}" data-toggle="tab">{{$item_categoria->nome}}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="card-body tab-content">
                    @foreach ($categorias as $item_categoria)
                        <div class="tab-pane @if($item_categoria->id == 1) show active @endif" id="tab{{ $item_categoria->id }}">
                            <div class="row d-flex justify-content-center">
                                @foreach (App\Models\Produto::all()->where('categoria_id', $item_categoria->id) as $produto)
                                    <div class="col-auto mt-2 mb-4">
                                        <div data-produto-id="{{$produto->id}}" class="card card-produto" style="width: 300px;height: 400px;">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-center mb-4">
                                                    <img class="card-img-top rounded border" style="height: 150px; width:auto;" src="{{ asset("/imgs/$produto->img") }}" alt="Card image cap">
                                                </div>
                                                <h5 class="card-title mt-1">{{ $produto->nome }}</h5>
                                                <p class="card-text">
                                                    {{ $produto->descricao }}
                                                    <br>
                                                    <small class="text-muted">
                                                        {{ $produto->qtd_estoque }} unidades restantes
                                                    </small>
                                                </p>
                                            </div>
                                            <div class="card-footer row">
                                                <div class="col-6">
                                                    R${{ $produto->valor }}.00
                                                </div>
                                                <div class="col-6 mt-1">   
                                                    <a data-produto-id="{{ $produto->id }}" class="btn btn-success button border cart-button">Adicionar ao carrinho <i class="fas fa-shopping-cart"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $(".alert-ajax").hide(); 
    });

    $('.cart-button').click(function(){
        var product_id = $(this).data('produto-id');
        const url = "{{ route('addCarrinho', ':id') }}";
        var route = url.replace(':id', product_id);

        $.ajax( {
            url: route,
            type: 'get',
            success: function(result){
                total = parseFloat(document.getElementById('total-carrinho').innerHTML) + 1;
                $('#total-carrinho').html(total).fadeIn(500);

                swal({
                    text: "Produto adicionado ao carrinho",
                    icon: 'success',
                    type: "success",
                    buttons: false,
                    timer: 1500
                });
            }
        });
    });

</script>
@endsection