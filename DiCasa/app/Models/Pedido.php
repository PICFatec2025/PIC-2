<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;
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
    public function pedidoPrato(){
        return $this->hasMany(PedidoPrato::class);
    }
}

