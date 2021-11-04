<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
            ['nome' => 'Admin']
        ]);

        DB::table('categoria_produtos')->insert([['nome' => "Pães"], ['nome' => "Bolos e Tortas"],
            ['nome' => "Salgados"],['nome' => "Doces"], ['nome' => "Bebidas"]
        ]);
        
        DB::table('pedido_pagamentos')->insert([
            ['nome' => "Dinheiro"], ['nome' => "Cartão de Crédito"], ['nome' => "Cartão de Débito"] 
        ]);

        $this->call([
            Produtos::class
        ]);

        DB::table('users')->insert([
            [
                'name' => 'Gabriel Oliveira',
                'cpf' => "50779690869",
                'role_id' => 1,
                'email' => "gabriel@gmail.com",
                'email_verified_at' => now(),
                'password' => Hash::make('gabriel123'), // password
                'remember_token' => Str::random(10),
            ], 
            [
                'name' => 'Administrador',
                'cpf' => "00000000000",
                'role_id' => 2,
                'email' => "admin@admin.com",
                'email_verified_at' => now(),
                'password' => Hash::make('admin123admin'), // password
                'remember_token' => Str::random(10),
            ]
        ]);

        DB::table('enderecos')->insert([
            [
                'user_id' => 1,
                'cidade' => "Mogi Mirim",
                'rua' => 'Conselheiro Rodrigues Alves',
                'numero' => 17,
                'bairro' => 'Centro',
            ]
        ]);
    }
}
