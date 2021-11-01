<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pedido;
use App\Models\Produto;
use App\Models\PedidoProduto;

class PedidoController extends Controller
{
    public function fazerPedido(Request $request){
        $user = Auth::user();
        $carrinho = \Cart::session($user->id);

        $taxaEntrega = 4;

        $pedido = new Pedido();
        $pedido->user_id = $user->id;
        $pedido->metodo_pagamento_id = $request->metodoPagamento;
        $pedido->valorTotal = $carrinho->getTotal() + $taxaEntrega;
        
        // Fazendo para cada item no carrinho, um item no banco de dados (tabela PedidoProdutos)
        foreach ($carrinho->getContent() as $item) {
            $produto_pedido = new PedidoProduto();
            $produto_pedido->pedido_id = $pedido->id;
            $produto_pedido->produto_id = $item->associatedModel->id;
            $produto_pedido->qtd = $item->quantity;
            $produto_pedido->valor = $item->price;

            // Retirando a quantidade comprada do estoque do produto
            $produto = Produto::find($item->associatedModel->id);
            $produto->qtd_estoque -= $item->quantity;
            $produto->save();

            $produto_pedido->save();
        }

        $pedido->save();

        return redirect('/')->with('success', 'Seu pedido foi realizado com sucesso');
    }
}
