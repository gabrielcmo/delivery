<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    // Rotas Carrinho
    Route::get("/carrinho", [App\Http\Controllers\CarrinhoController::class, 'view'])
        ->name('viewCarrinho');
    Route::get("/carrinho/add/{product_id}", [App\Http\Controllers\CarrinhoController::class, 'adicionar'])
        ->name('addCarrinho');
    Route::get('/carrinho/limpar', [App\Http\Controllers\CarrinhoController::class, 'limpar'])
        ->name('limparCarrinho');
    Route::get('/carrinho/remover/{id}', [App\Http\Controllers\CarrinhoController::class, 'removerItem'])
        ->name('removerItem');
    Route::post('/checkout/pedido', [App\Http\Controllers\CarrinhoController::class, 'atualizar'])->name('checkoutPedido');

    // Rotas Usuário
    Route::get('/editar', function () {
        return view('auth.editarPerfil');
    })->name('editarPerfilView');

    Route::post('/user/edit', [App\Http\Controllers\UserController::class, 'update'])->name('editarPerfil');

    // Rotas Pedido
    Route::post('/checkout/pedido/finalizado', [App\Http\Controllers\PedidoController::class, 'fazerPedido'])->name('endCheckoutPedido');
    Route::get('/pedidos', [App\Http\Controllers\PedidoController::class, 'pedidosView'])->name('pedidosView');

    // Rotas ADMIN
    Route::middleware(['admin'])->group(function () {
        Route::get('/admin/pedidos', [App\Http\Controllers\AdminController::class, 'pedidosView'])->name('pedidosAdminView');
        // Rotas de controle dos pedidos
        Route::get('admin/pedido/{id}/aceitar', [App\Http\Controllers\AdminController::class, 'aceitarPedido'])->name('aceitarPedido');
        Route::get('admin/pedido/{id}/entregar', [App\Http\Controllers\AdminController::class, 'statusSaiuParaEntrega'])->name('aEntregar');
        Route::get('admin/pedido/{id}/entregue', [App\Http\Controllers\AdminController::class, 'statusEntregue'])->name('pedidoEntregue');

        Route::get('/admin/vendas', [App\Http\Controllers\AdminController::class, 'vendasView'])->name('vendasView');
        Route::post('/admin/vendas/periodo', [App\Http\Controllers\AdminController::class, 'vendasPeriodo'])->name('selecionarVendasPeriodo');
        Route::get('/admin/produtos', [App\Http\Controllers\AdminController::class, 'produtosView'])->name('produtosView');
        Route::get('/admin/clientes', [App\Http\Controllers\AdminController::class, 'clientesView'])->name('clientesView');
    });
});

// Rota Usuário
Auth::routes();