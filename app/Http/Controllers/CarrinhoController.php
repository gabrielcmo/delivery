<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Produto;

class CarrinhoController extends Controller
{
    public function view(){
        return view('carrinho');
    }

    public function adicionar(Request $request, $product_id){
        $user = Auth::user();
        $carrinho = \Cart::session($user->id);

        $produto = Produto::find($product_id);

        $carrinho->add(array(
            'id' => $produto->id,
            'name' => $produto->nome,
            'price' => $produto->valor,
            'quantity' => 1,
            'attributes' => array(
                'img' => $produto->img
            ),
            'associatedModel' => $produto
        ));
        
        return back()->with('success', 'Produto adicionado ao carrinho.');
    }

    public function limpar(){
        $user = Auth::user();
        $carrinho = \Cart::session($user->id);
        $carrinho->clear();

        return redirect()->back()->with('success', 'Carrinho limpo com sucesso.');
    }

    public function atualizar(Request $request){
        $user = Auth::user();
        $carrinho = \Cart::session($user->id);
        
        foreach ($carrinho->getContent() as $item) {
            $qtd = "qtd{$item->associatedModel->id}";

            $carrinho->update($item->id, [
                'quantity' => array(
                    'relative' => false,
                    'value' => $request->$qtd
                )
            ]);
        }

        return view('checkoutPedido');
    }
}