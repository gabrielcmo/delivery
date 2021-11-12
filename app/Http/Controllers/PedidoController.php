<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pedido;
use App\Models\Produto;
use App\Models\PedidoProduto;

class PedidoController extends Controller
{
    /*
        Status dos pedidos:
            1- Aguardando aprovação
            2- Em preparo
            3- Saiu para entrega
            4- Entegue
            5- Cancelado

            Obs: o cliente pode cancelar o pedido apenas que ainda não foi aceito, em um prazo de até 1 minuto.
    */
    public function fazerPedido(Request $request){
        $user = Auth::user();
        $carrinho = \Cart::session($user->id);

        $taxaEntrega = 4;

        if($carrinho->getTotalQuantity() == 0){
            return redirect()->back()->with('error', 'Parece que você não tem nenhum item no carrinho, verifique se você
            já fez seu pedido. Caso não tenha feito, faça novamente, por gentileza.');
        }

        if($request->metodoPagamento == null){
            return redirect()->back()->with('error', 'Por favor, selecione um método de pagamento.');
        }

        $pedido = new Pedido();
        $pedido->user_id = $user->id;
        $pedido->metodo_pagamento_id = $request->metodoPagamento;
        $pedido->status_id = 1;
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

        // Tempo aproximado de entrega, em minutos
        $pedidos_aguardando_preparo = Pedido::where('status_id', 1)->get()->count();
        if($pedidos_aguardando_preparo >= 6){
            $tempo_estimado_entrega = 50;
        }elseif($pedidos_aguardando_preparo < 6 && $pedidos_aguardando_preparo >= 3){
            $tempo_estimado_entrega = 40;
        }else{
            $tempo_estimado_entrega = 30;
        }

        return redirect('/pedidos')
            ->with('tempo_estimado_entrega', $tempo_estimado_entrega)
            ->with('success', 'Seu pedido foi realizado com sucesso');
    }

    public function pedidosView(){
        return view('auth.pedidos');
    }
}
