<?php

namespace Database\Factories;

use App\Models\Produto;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProdutoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Produto::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'img' => "https://source.unsplash.com/random/200x200",
            'nome' => $this->faker->name(),
            'valor' => rand(5,80),
            'descricao' => $this->faker->name(),
            'qtd_estoque' => rand(2,30),
            'categoria_id' => rand(1,8)
        ];
    }
}
