<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'total_preco',
        'taxa_entrega',
        'observacao',
        'forma_pagamento',
        'modo_retirada',
        'esta_produzindo',
        'foi_produzido',
        'foi_entregue',
        'cliente_id'
    ];
    
    protected $casts = [
        'total_preco' => 'decimal:2',
        'taxa_entrega' => 'decimal:2',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function pedidoPrato()
    {
        return $this->hasMany(PedidoPrato::class);
    }
}