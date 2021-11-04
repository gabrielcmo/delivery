<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidoProdutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedido_produtos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pedido_id')->constrained('pedidos')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreignId('produto_id')->constrained('produtos')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->string('nome');
            $table->foreignId('categoria_id')->constrained('categoria_produtos')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->smallInteger('qtd');
            $table->float('valor', 6, 2);
            $table->float('valor_total', 8, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pedido_produtos');
    }
}
