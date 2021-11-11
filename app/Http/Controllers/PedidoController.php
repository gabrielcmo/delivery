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

        if($request->metodoPagamento == null){
            return redirect()->back()->with('error', 'Por favor, selecione um método de pagamento.');
        }

        $pedido = new Pedido();
        $pedido->user_id = $user->id;
        $pedido->metodo_pagamento_id = $request->metodoPagamento;
        $pedido->valor = $carrinho->getTotal() + $taxaEntrega;
        $pedido->save();
        
        // Fazendo para cada item no carrinho, um item no banco de dados (tabela PedidoProdutos)
        foreach ($carrinho->getContent() as $item) {
            // Produto associado ao carrinho
            $produto = Produto::find($item->associatedModel->id);

            $produto_pedido = new PedidoProduto();
            $produto_pedido->pedido_id = $pedido->id;
            $produto_pedido->produto_id = $item->associatedModel->id;
            $produto_pedido->nome = $produto->nome;
            $produto_pedido->categoria_id = $produto->categoria->id;
            $produto_pedido->qtd = $item->quantity;
            $produto_pedido->valor = $item->price;
            $produto_pedido->valor_total = $item->price*$item->quantity;

            // Retirando a quantidade comprada do estoque do produto
            $produto->qtd_estoque -= $item->quantity;
            $produto->save();

            $produto_pedido->save();
        }

        $carrinho->clear();

        return redirect('/')->with('success', 'Seu pedido foi realizado com sucesso');
    }

    public function pedidosView(){
        return view('auth.pedidos');
    }
}
