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

Route::get('/', function () {
    return view('index');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Rotas Carrinho
Route::middleware(['auth'])->group(function () {
    Route::get("/carrinho/add/{product_id}", [App\Http\Controllers\CarrinhoController::class, 'adicionar'])
        ->name('addCarrinho');
    Route::get('/carrinho/limpar', [App\Http\Controllers\CarrinhoController::class, 'limpar'])
        ->name('limparCarrinho');
});

// Rotas Usuário
Auth::routes();

Route::get('/editar', function () {
    return view('auth.editarPerfil');
})->name('editarPerfilView');

Route::post('/user/edit', [App\Http\Controllers\UserController::class, 'update'])->name('editarPerfil');