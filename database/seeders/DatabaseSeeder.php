<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->create();

        DB::table('categoria_produtos')->insert([['nome' => "Cestas"],['nome' => "Pães"],
            ['nome' => "Bolos e Tortas"],['nome' => "Salgados"],
            ['nome' => "Lanches"],['nome' => "Doces"],
            ['nome' => "Sucos"],['nome' => "Refrigerantes"]
        ]);
        
        DB::table('pedido_pagamentos')->insert(
            ['nome' => "Dinheiro"],['nome' => "Cartão"]
        );

        \App\Models\Produto::factory(50)->create();
    }
}
