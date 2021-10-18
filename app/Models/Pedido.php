<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;
    
    public $timestamps = true;

    public function metodo_pagamento(){
        return $this->hasOne('App\PedidoPagamento');
    }

    public function produtos(){
        return $this->hasMany('App\PedidoProduto')->withPivot('qtd');
    }

    public function user(){
        return $this->hasOne('App\User');
    }
}
