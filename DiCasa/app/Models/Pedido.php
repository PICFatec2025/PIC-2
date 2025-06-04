<?php

namespace App\Models;

<<<<<<< HEAD
=======
use Illuminate\Database\Eloquent\Factories\HasFactory;

>>>>>>> f3dc1799141b22dd243d5bd2fdf0b212cf7e3675
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
<<<<<<< HEAD
=======

>>>>>>> f3dc1799141b22dd243d5bd2fdf0b212cf7e3675
    protected $fillable =[
            'total_preco',
            'taxa_entrega',
            'observacao',
            'forma_pagamento',
            'foi_produzido',
            'foi_entregue',
            'cliente_id'
    ];
    public function cliente(){
        return $this->belongsTo(Cliente::class);
    }
}

