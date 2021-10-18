<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PedidoProduto extends Model
{
    use HasFactory;

    public function pedido(){
        return $this->belongsToOne('App\Pedido');
    }

    public function produtos(){
        return $this->hasMany('App\Produto')->withPivot('qtd');
    }
}
