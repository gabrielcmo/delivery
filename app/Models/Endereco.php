<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'cidade',
        'rua',
        'bairro',
        'numero',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
