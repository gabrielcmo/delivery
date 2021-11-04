<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $guarded = [
        'user_id',
        'metodo_pagamento_id',
        'valor'
    ];
    
    public $timestamps = true;

    public function metodo_pagamento(){
        return $this->hasOne('App\Models\PedidoPagamento');
    }

    public function produtos(){
        return $this->hasMany('App\Models\PedidoProduto');
    }

    public function user(){
        return $this->hasOne('App\Models\User');
    }
}
