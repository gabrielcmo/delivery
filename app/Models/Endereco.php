<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    use HasFactory;

    protected $fillable = [
        'cidade',
        'rua',
        'bairro',
        'numero',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
