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
        DB::table('user_roles')->insert([
            ['nome' => 'Cliente'],
            ['nome' => 'Motoboy'],
            ['nome' => 'Admin']
        ]);

        \App\Models\User::factory(10)->create();

        DB::table('categoria_produtos')->insert([['nome' => "Pães"], ['nome' => "Bolos e Tortas"],
            ['nome' => "Salgados"],['nome' => "Doces"], ['nome' => "Bebidas"]
        ]);
        
        DB::table('pedido_pagamentos')->insert(
            ['nome' => "Dinheiro"], ['nome' => "Cartão"]
        );

        \App\Models\Produto::factory(40)->create();
    }
}
