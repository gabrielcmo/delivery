<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Produtos extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('produtos')->insert([
            [
                'img' => "pao-frances.jpg",
                'nome' => "Pão francês - 60 gramas",
                'valor' => 0.95,
                'descricao' => "Pão francês maravilhoso, produzido com farinha argentina cultivada sem uso de agrotóxicos",
                'qtd_estoque' => 50,
                'categoria_id' => 1
            ],
            [
                'img' => "pao-panco.jpg",
                'nome' => "Pão de forma PANCO",
                'valor' => 0.95,
                'descricao' => "Pão de forma maravilhoso, pacote tradicional de 500g",
                'qtd_estoque' => 50,
                'categoria_id' => 1
            ],
            [
                'img' => "pao-forma-fatiado.jpg",
                'nome' => "Pão de forma Caseiro fatiado",
                'valor' => 0.95,
                'descricao' => "Pão de forma caseiro, peso: 500g",
                'qtd_estoque' => 50,
                'categoria_id' => 1
            ],
            [
                'img' => "pao-artesanal.jpg",
                'nome' => "Pão artesanal - 2 unidades",
                'valor' => 3.00,
                'descricao' => "Pão levemente amanteigado, com sabor de casa",
                'qtd_estoque' => 30,
                'categoria_id' => 1
            ],
            [
                'img' => "pao-ninho.jpg",
                'nome' => "Pão de leite ninho - 4 unidades",
                'valor' => 13.00,
                'descricao' => "",
                'qtd_estoque' => 25,
                'categoria_id' => 1
            ],
            [
                'img' => "pao-de-queijo.jpg",
                'nome' => "Pão de queijo",
                'valor' => 4.00,
                'descricao' => "",
                'qtd_estoque' => 30,
                'categoria_id' => 1
            ],
            [
                'img' => "pao-pizza.jpg",
                'nome' => "Pão de Pizza recheado",
                'valor' => 16.00,
                'descricao' => "200 gramas",
                'qtd_estoque' => 8,
                'categoria_id' => 1
            ],
            [
                'img' => "bolo-mesclado.jpg",
                'nome' => "Bolo mesclado",
                'valor' => 30.00,
                'descricao' => "Bolo inteiro mesclado com massa branca e massa de chocolate, peso de 1 kg",
                'qtd_estoque' => 2,
                'categoria_id' => 2
            ],
            [
                'img' => "bolo-cenoura.jpeg",
                'nome' => "Bolo de cenoura com cobertura de brigadeiro",
                'valor' => 30.00,
                'descricao' => "Bolo inteiro, com 1 kg",
                'qtd_estoque' => 2,
                'categoria_id' => 2
            ],
            [
                'img' => "pedaco-bolo-cenoura.jpg",
                'nome' => "Pedaço de bolo de cenoura com cobertura de brigadeiro",
                'valor' => 30.00,
                'descricao' => "Pedaço de bolo de cenoura, com 180 gramas",
                'qtd_estoque' => 2,
                'categoria_id' => 2
            ],
            [
                'img' => "bolo-chocolate.jpg",
                'nome' => "Bolo de chocolate com cobertura de brigadeiro",
                'valor' => 50.00,
                'descricao' => "Bolo inteiro, com 1.5 kg",
                'qtd_estoque' => 2,
                'categoria_id' => 2
            ],
            [
                'img' => "pedaco-bolo-chocolate.jpg",
                'nome' => "Pedaço de bolo de chocolate com cobertura de brigadeiro",
                'valor' => 14.00,
                'descricao' => "Pedaço com 180 gramas",
                'qtd_estoque' => 24,
                'categoria_id' => 2
            ],
            [
                'img' => "esfiha-carne.jpg",
                'nome' => "Esfiha de carne",
                'valor' => 8.00,
                'descricao' => "",
                'qtd_estoque' => 10,
                'categoria_id' => 3
            ],
            [
                'img' => "esfiha-frango.jpeg",
                'nome' => "Esfiha de frango",
                'valor' => 8.00,
                'descricao' => "",
                'qtd_estoque' => 5,
                'categoria_id' => 3
            ],
            [
                'img' => "hamburger-carne.png",
                'nome' => "Hamburguer de carne",
                'valor' => 4.00,
                'descricao' => "",
                'qtd_estoque' => 12,
                'categoria_id' => 3
            ],
            [
                'img' => "hamburger-carne-cheddar.png",
                'nome' => "Hamburguer de carne com cheddar",
                'valor' => 5.00,
                'descricao' => "",
                'qtd_estoque' => 8,
                'categoria_id' => 3
            ],
            [
                'img' => "hamburger-duplo-cheddar.jpg",
                'nome' => "Hamburguer duplo de carne com cheddar",
                'valor' => 6.00,
                'descricao' => "",
                'qtd_estoque' => 4,
                'categoria_id' => 3
            ],
            [
                'img' => "hamburger-carne-bacon.jpg",
                'nome' => "Hamburguer duplo de carne com bacon",
                'valor' => 7.00,
                'descricao' => "",
                'qtd_estoque' => 3,
                'categoria_id' => 3
            ],
            [
                'img' => "coxinha.jpg",
                'nome' => "Coxinha",
                'valor' => 6.00,
                'descricao' => "",
                'qtd_estoque' => 12,
                'categoria_id' => 3
            ],
            [
                'img' => "misto.jpg",
                'nome' => "Misto quente",
                'valor' => 4.00,
                'descricao' => "Delicioso misto quente feito no pão francês",
                'qtd_estoque' => 12,
                'categoria_id' => 3
            ],
            [
                'img' => "americano.jpg",
                'nome' => "Americano de presunto e queijo",
                'valor' => 8.00,
                'descricao' => "",
                'qtd_estoque' => 4,
                'categoria_id' => 3
            ],
            [
                'img' => "enroladinho-presu-queijo.jpg",
                'nome' => "Enroladinho de presunto e queijo",
                'valor' => 8.00,
                'descricao' => "",
                'qtd_estoque' => 4,
                'categoria_id' => 3
            ],
            [
                'img' => "enroladinho-queijo.jpg",
                'nome' => "Enroladinho de queijo",
                'valor' => 8.00,
                'descricao' => "",
                'qtd_estoque' => 2,
                'categoria_id' => 3
            ],
            [
                'img' => "pastel-nutella.jpeg",
                'nome' => "Pastel de nutella",
                'valor' => 12.00,
                'descricao' => "",
                'qtd_estoque' => 2,
                'categoria_id' => 4
            ],
            [
                'img' => "pastel-doce-leite.jpg",
                'nome' => "Pastel de doce de leite",
                'valor' => 9.00,
                'descricao' => "",
                'qtd_estoque' => 2,
                'categoria_id' => 4
            ],
            [
                'img' => "pastel-ninho-nutella.jpg",
                'nome' => "Pastel de leite ninho recheado com nutella",
                'valor' => 9.00,
                'descricao' => "",
                'qtd_estoque' => 2,
                'categoria_id' => 4
            ],
            [
                'img' => "nutella.jpg",
                'nome' => "Pote de nutella",
                'valor' => 19.90,
                'descricao' => "",
                'qtd_estoque' => 40,
                'categoria_id' => 4
            ],
            [
                'img' => "doce-leite-caseiro.jpg",
                'nome' => "Doce de leite caseiro",
                'valor' => 12.00,
                'descricao' => "Pote com 400 gramas",
                'qtd_estoque' => 14,
                'categoria_id' => 4
            ],
            [
                'img' => "doce-morango-rittner.jpg",
                'nome' => "Doce Cremoso de Morango - Ritter",
                'valor' => 18.00,
                'descricao' => "380 gramas",
                'qtd_estoque' => 8,
                'categoria_id' => 4
            ],
            [
                'img' => "fini-morango.jpg",
                'nome' => "Fini Morango Cítrico 90g",
                'valor' => 5.90,
                'descricao' => "",
                'qtd_estoque' => 55,
                'categoria_id' => 4
            ],
            [
                'img' => "piru-yogurte.jpeg",
                'nome' => "Pirulito Yogurte Morango - 10 unidades",
                'valor' => 4.90,
                'descricao' => "",
                'qtd_estoque' => 40,
                'categoria_id' => 4
            ],
            [
                'img' => "coca-2l.jpg",
                'nome' => "Refrigerante Coca Cola 2L",
                'valor' => 9.00,
                'descricao' => "",
                'qtd_estoque' => 32,
                'categoria_id' => 5
            ],
            [
                'img' => "coca-600.jpg",
                'nome' => "Refrigerante Coca Cola 600ml",
                'valor' => 6.00,
                'descricao' => "",
                'qtd_estoque' => 21,
                'categoria_id' => 5
            ],
            [
                'img' => "coca-lata.jpg",
                'nome' => "Refrigerante Coca Cola lata",
                'valor' => 4.50,
                'descricao' => "",
                'qtd_estoque' => 12,
                'categoria_id' => 5
            ],
            [
                'img' => "ant-2l.jpg",
                'nome' => "Refrigerante Guaraná Antáctica 2L",
                'valor' => 8.00,
                'descricao' => "",
                'qtd_estoque' => 29,
                'categoria_id' => 5
            ],
            [
                'img' => "ant-600.jpg",
                'nome' => "Refrigerante Guaraná Antáctica 600ml",
                'valor' => 6.00,
                'descricao' => "",
                'qtd_estoque' => 21,
                'categoria_id' => 5
            ],
            [
                'img' => "ant-lata.jpg",
                'nome' => "Refrigerante Guaraná Antáctica lata",
                'valor' => 4.50,
                'descricao' => "",
                'qtd_estoque' => 12,
                'categoria_id' => 5
            ],
            [
                'img' => "sprite.jpg",
                'nome' => "Refrigerante Sprite 2L",
                'valor' => 8.00,
                'descricao' => "",
                'qtd_estoque' => 16,
                'categoria_id' => 5
            ],
            [
                'img' => "fanta-uva.jpg",
                'nome' => "Refrigerante Fanta Uva 2L",
                'valor' => 8.00,
                'descricao' => "",
                'qtd_estoque' => 32,
                'categoria_id' => 5
            ],
            [
                'img' => "fanta-laranja.jpg",
                'nome' => "Refrigerante Fanta Laranja 2L",
                'valor' => 8.00,
                'descricao' => "",
                'qtd_estoque' => 32,
                'categoria_id' => 5
            ],
            [
                'img' => "mogi-maça.jpeg",
                'nome' => "Refrigerante Mogi Maçã 2L",
                'valor' => 5.00,
                'descricao' => "",
                'qtd_estoque' => 18,
                'categoria_id' => 5
            ],
            [
                'img' => "mogi-abacaxi.jpeg",
                'nome' => "Refrigerante Mogi Abacaxi 2L",
                'valor' => 5.00,
                'descricao' => "",
                'qtd_estoque' => 20,
                'categoria_id' => 5
            ],
            [
                'img' => "mogi-guarana.jpeg",
                'nome' => "Refrigerante Mogi Guaraná 2L",
                'valor' => 5.00,
                'descricao' => "",
                'qtd_estoque' => 20,
                'categoria_id' => 5
            ],
        ]);
    }
}
