<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreignId('metodo_pagamento_id')->constrained('pedido_pagamentos')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreignId('status_id')->constrained('pedido_statuses')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->float('valor', 8, 2);
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
        Schema::dropIfExists('pedidos');
    }
}
