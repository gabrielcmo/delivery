<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PedidoProduto;
use App\Models\Produto;
use App\Models\CategoriaProduto;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function vendasPeriodo(Request $request){
        $pedidos = Pedido::all()
            ->where('created_at', '>=', $request->from)
            ->where('created_at', '<=', $request->to)
            ->get();
        
        return back()->with('pedidos', json_encode($pedidos));
    }

    public function vendasView(){
        
        $categorias = CategoriaProduto::all();

        foreach ($categorias as $categoria) {
            $categoria_nome[$categoria->id] = $categoria->nome;

            $produtos_vendidos[$categoria->id] = PedidoProduto::select(
                DB::raw('SUM(qtd) as qtd_vendida'), 
                DB::raw('SUM(valor_total) as valor_total_vendido'))
                ->where('categoria_id', $categoria->id)
                ->get();
        }

        $res[] = ['Categoria', 'Quantidade Vendida'];
        foreach ($produtos_vendidos as $key => $val) {
            if($val[0]->qtd_vendida == null){
                $val[0]->qtd_vendida = 0;
            }

            if($val[0]->valor_total_vendido == null){
                $val[0]->valor_total_vendido = 0;
            }

            $res[$key] = ["$categoria_nome[$key]", intval($val[0]->qtd_vendida)];
        }

        return view('admin.vendas')
            ->with('vendas', json_encode($res));
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
