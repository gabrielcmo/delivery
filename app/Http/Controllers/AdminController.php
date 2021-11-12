<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PedidoProduto;
use App\Models\Pedido;
use App\Models\Produto;
use App\Models\CategoriaProduto;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
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

    // Idéia: dar ao cliente um tempo estimado de entrega em função da quantidade de pedidos aguardando aprovação.
    public function aceitarPedido(Request $request){
        $pedido_id = $request->pedido_id;

        $pedido = Pedido::find($pedido_id);

        $pedido->status_id = 2;
        $pedido->save();

        return back()->with('success', "Pedido $pedido_id aceito com sucesso!");
    }

    public function statusSaiuParaEntrega(Request $request){
        $pedido_id = $request->pedido_id;

        $pedido = Pedido::find($pedido_id);

        $pedido->status_id = 3;
        $pedido->save();

        return back()->with('success', "Pedido $pedido_id atualizado com sucesso!");
    }

    public function statusEntregue(Request $request){
        $pedido_id = $request->pedido_id;

        $pedido = Pedido::find($pedido_id);

        $pedido->status_id = 4;
        $pedido->save();

        return back()->with('success', "Pedido $pedido_id atualizado com sucesso!");
    }

    public function vendasPeriodo(Request $request){
        // Período a ser avaliado
        $from = $request->from." 23:59:59";
        $to = $request->to." 23:59:59";

        $pedidos = Pedido::all()->whereBetween('created_at', [$from, $to]);

        $qtd_pedidos_feitos = $pedidos->count();
        
        $categorias = CategoriaProduto::all();

        foreach ($categorias as $categoria) {
            $categoria_nome[$categoria->id] = $categoria->nome;

            $produtos_vendidos[$categoria->id] = PedidoProduto::select(
                DB::raw('SUM(qtd) as qtd_vendida'), 
                DB::raw('SUM(valor_total) as valor_total_vendido'))
                ->where('categoria_id', $categoria->id)
                ->whereBetween('created_at', [$from, $to])
                ->get();
        }

        $top_5_vendidos = PedidoProduto::select('produto_id', DB::raw('count(*) as total'))
            ->groupBy('produto_id')
            ->orderByRaw('count(*) DESC')
            ->limit(5)
            ->whereBetween('created_at', [$from, $to])
            ->get();

        if($pedidos->count() !== 0){
            //Calculando a quantidade de pedidos por cada método de pagamento
            $pedidos_metodo_pagamento_dinheiro = Pedido::where('metodo_pagamento_id', 1)
                ->whereBetween('created_at', [$from, $to])->get()->count();
            $pedidos_metodo_pagamento_credito = Pedido::where('metodo_pagamento_id', 2)
                ->whereBetween('created_at', [$from, $to])->get()->count();
            $pedidos_metodo_pagamento_debito = Pedido::where('metodo_pagamento_id', 3)
                ->whereBetween('created_at', [$from, $to])->get()->count();
            
            $cliente_fiel_id = Pedido::select('user_id', DB::raw('count(*) as total'))
                ->groupBy('user_id')
                ->orderByRaw('count(*) DESC')
                ->limit(1)
                ->whereBetween('created_at', [$from, $to])
                ->pluck('user_id');

            $total_comprado = Pedido::select(DB::raw("SUM(valor) as total"))
                ->whereBetween('created_at', [$from, $to])
                ->where('user_id', $cliente_fiel_id)->get();

            $total_pedidos = Pedido::where('user_id', $cliente_fiel_id)
                ->whereBetween('created_at', [$from, $to])    
                ->count();

            $cliente_fiel["email"] = User::find($cliente_fiel_id[0])->email;
            $cliente_fiel["total_pedidos"] = $total_pedidos;
            $cliente_fiel["total_comprado"] = $total_comprado[0]->total;
        }else{
            //Caso não haja nenhum pedido ainda, definimos tudo como zero
            $pedidos_metodo_pagamento_dinheiro = 0;
            $pedidos_metodo_pagamento_credito = 0;
            $pedidos_metodo_pagamento_debito = 0;

            $cliente_fiel["total_pedidos"] = 0;
            $cliente_fiel["email"] = "";
            $cliente_fiel["total_comprado"] = 0;
        }

        $total_vendido = 0;
        
        $vendasPorMetodoPagamento[] = ['Método de Pagamento', 'Quantidade de Pedidos'];
        $vendasPorMetodoPagamento[] = ["Dinheiro", $pedidos_metodo_pagamento_dinheiro];
        $vendasPorMetodoPagamento[] = ["Cartão de Crédito", $pedidos_metodo_pagamento_credito];
        $vendasPorMetodoPagamento[] = ["Cartão de Débito", $pedidos_metodo_pagamento_debito];

        $res[] = ['Categoria', 'Quantidade Vendida'];
        foreach ($produtos_vendidos as $key => $val) {
            if($val[0]->qtd_vendida == null){
                $val[0]->qtd_vendida = 0;
            }

            if($val[0]->valor_total_vendido == null){
                $val[0]->valor_total_vendido = 0;
            }

            $total_vendido += $val[0]->valor_total_vendido;

            $res[$key] = ["$categoria_nome[$key]", intval($val[0]->qtd_vendida)];
        }

        return view('admin.vendas')
            ->with('vendas', json_encode($res))
            ->with('qtd_pedidos_feitos', $qtd_pedidos_feitos)
            ->with('cliente_fiel', $cliente_fiel)
            ->with('top_5_vendidos', $top_5_vendidos)
            ->with('vendasPorMetodoPagamento', json_encode($vendasPorMetodoPagamento))
            ->with('to', $request->to)
            ->with('from', $request->from)
            ->with('total_vendido', $total_vendido);
    }

    public function vendasView(){

        $pedidos = Pedido::all();
        $qtd_pedidos_feitos = $pedidos->count();
        
        $categorias = CategoriaProduto::all();

        foreach ($categorias as $categoria) {
            $categoria_nome[$categoria->id] = $categoria->nome;

            $produtos_vendidos[$categoria->id] = PedidoProduto::select(
                DB::raw('SUM(qtd) as qtd_vendida'), 
                DB::raw('SUM(valor_total) as valor_total_vendido'))
                ->where('categoria_id', $categoria->id)
                ->get();
        }

        $top_5_vendidos = PedidoProduto::select('produto_id', DB::raw('count(*) as total'))
            ->groupBy('produto_id')
            ->orderByRaw('count(*) DESC')
            ->limit(5)
            ->get();

        if($pedidos->count() !== 0){
            //Calculando a quantidade de pedidos por cada método de pagamento
            $pedidos_metodo_pagamento_dinheiro = Pedido::where('metodo_pagamento_id', 1)->get()->count();
            $pedidos_metodo_pagamento_credito = Pedido::where('metodo_pagamento_id', 2)->get()->count();
            $pedidos_metodo_pagamento_debito = Pedido::where('metodo_pagamento_id', 3)->get()->count();

            $cliente_fiel_id = Pedido::select('user_id', DB::raw('count(*) as total'))
                ->groupBy('user_id')
                ->orderByRaw('count(*) DESC')
                ->limit(1)
                ->pluck('user_id');
    
            $total_comprado = Pedido::select(DB::raw("SUM(valor) as total"))
                ->where('user_id', $cliente_fiel_id)->get();

            $total_pedidos = Pedido::where('user_id', $cliente_fiel_id)->count();
    
            $cliente_fiel["email"] = User::find($cliente_fiel_id[0])->email;
            $cliente_fiel["total_pedidos"] = $total_pedidos;
            $cliente_fiel["total_comprado"] = $total_comprado[0]->total;
        }else{
            //Caso não haja nenhum pedido ainda, definimos tudo como zero
            $pedidos_metodo_pagamento_dinheiro = 0;
            $pedidos_metodo_pagamento_credito = 0;
            $pedidos_metodo_pagamento_debito = 0;

            $cliente_fiel["total_pedidos"] = 0;
            $cliente_fiel["email"] = "";
            $cliente_fiel["total_comprado"] = 0;
        }

        $total_vendido = 0;

        $vendasPorMetodoPagamento[] = ['Método de Pagamento', 'Quantidade de Pedidos'];
        $vendasPorMetodoPagamento[] = ["Dinheiro", $pedidos_metodo_pagamento_dinheiro];
        $vendasPorMetodoPagamento[] = ["Cartão de Crédito", $pedidos_metodo_pagamento_credito];
        $vendasPorMetodoPagamento[] = ["Cartão de Débito", $pedidos_metodo_pagamento_debito];

        $res[] = ['Categoria', 'Quantidade Vendida'];
        foreach ($produtos_vendidos as $key => $val) {
            if($val[0]->qtd_vendida == null){
                $val[0]->qtd_vendida = 0;
            }

            if($val[0]->valor_total_vendido == null){
                $val[0]->valor_total_vendido = 0;
            }

            $total_vendido += $val[0]->valor_total_vendido;

            $res[$key] = ["$categoria_nome[$key]", intval($val[0]->qtd_vendida)];
        }

        return view('admin.vendas')
            ->with('vendas', json_encode($res))
            ->with('qtd_pedidos_feitos', $qtd_pedidos_feitos)
            ->with('cliente_fiel', $cliente_fiel)
            ->with('top_5_vendidos', $top_5_vendidos)
            ->with('vendasPorMetodoPagamento', json_encode($vendasPorMetodoPagamento))
            ->with('total_vendido', $total_vendido);
    }

    public function produtosView(){
        
        $produtos = Produto::all();

        return view('admin.produtos')
            ->with('produtos', $produtos);
    }

    public function clientesView(){
        
        $clientes = User::all();

        return view('admin.clientes')
            ->with('clientes', $clientes);
    }
}
