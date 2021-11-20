@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @php $produto = App\Models\Produto::find($id); @endphp
            <div class="card">
                <div class="card-header">{{ __("Editar produto $produto->id") }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('editarProduto') }}">
                        @csrf

                        <input type="hidden" name="produto_id" value="{{ $produto->id }}">

                        <div class="form-group row">
                            <label for="nome" class="col-md-4 col-form-label text-md-right">{{ __('Nome') }}</label>

                            <div class="col-md-6">
                                <input id="nome" type="text" class="form-control @error('nome') is-invalid @enderror" name="nome" value="{{ $produto->nome }}" required autocomplete="Nome" autofocus>

                                @error('nome')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="descricao" class="col-md-4 col-form-label text-md-right">{{ __('Descrição') }}</label>

                            <div class="col-md-6">
                                <input id="descricao" type="text" class="form-control @error('descricao') is-invalid @enderror" name="descricao" value="{{ $produto->descricao }}" required autocomplete="descricao" autofocus>

                                @error('descricao')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="valor" class="col-md-4 col-form-label text-md-right">{{ __('Valor') }}</label>

                            <div class="col-md-6">
                                <input id="valor" type="number" step="0.01" min=0 class="form-control @error('valor') is-invalid @enderror" name="valor" value="{{ $produto->valor }}" required autocomplete="Valor" autofocus>

                                @error('valor')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="qtd_estoque" class="col-md-4 col-form-label text-md-right">{{ __('Quantidade em Estoque') }}</label>

                            <div class="col-md-6">
                                <input id="qtd_estoque" type="text" class="form-control @error('qtd_estoque') is-invalid @enderror" name="qtd_estoque" value="{{ $produto->qtd_estoque }}" required autocomplete="Quantidade em estoque" autofocus>

                                @error('qtd_estoque')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="categoria_id" class="col-md-4 col-form-label text-md-right">{{ __('Categoria') }}</label>

                            <div class="col-md-6 mt-2">
                                <select name="categoria_id" id="categoria_id">
                                    @foreach (App\Models\CategoriaProduto::all() as $categoria)
                                        <option @if($produto->categoria->id == $categoria->id) selected @endif value="{{ $categoria->id }}">{{ $categoria->nome }}</option>
                                    @endforeach
                                </select>

                                @error('categoria_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="card-footer mb-0">
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-success">
                                {{ __('Salvar') }}
                            </button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection