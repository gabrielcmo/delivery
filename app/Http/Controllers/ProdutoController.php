<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;

class ProdutoController extends Controller
{
    public function update(Request $request){
        $produto = Produto::find($request->produto_id);

        $data = $this->validate($request, [
            'nome' => ['required', 'string', 'max:255'],
            'descricao' => ['string', 'max:255'],
            'valor' => ['required', 'min:0'],
            'qtd_estoque' => ['required', 'integer', 'min:1'],
            'categoria_id' => ['required', 'integer']
        ]);
        
        $produto->nome = $data['nome'];
        $produto->descricao = $data['descricao'];
        $produto->valor = $data['valor'];
        $produto->qtd_estoque = $data['qtd_estoque'];
        $produto->categoria_id = $data['categoria_id'];

        $produto->save();

        return redirect()->route('produtosView')->with('success', "Produto atualizado com sucesso!");
    }
}
