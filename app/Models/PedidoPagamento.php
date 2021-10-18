<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PedidoPagamento extends Model
{
    use HasFactory;

    public function pedidos(){
        return $this->belongsToMany('App\Pedido');
    }
}
