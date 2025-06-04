<?php

namespace App\Models;

<<<<<<< HEAD
=======
use Illuminate\Database\Eloquent\Factories\HasFactory;
>>>>>>> 5a9bdc5dcce23c3512fe3f63dd48103d065a809a
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
<<<<<<< HEAD
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
=======
    use HasFactory;

    protected $fillable = [
        'nome_cliente',
        'pedido',
        'hora',
        'tipo',
        'produzindo',
        'pronto',
        'entregue',
        'finalizado',
        'finalizado_em'
    ];

    protected $casts = [
        'produzindo' => 'boolean',
        'pronto' => 'boolean',
        'entregue' => 'boolean',
        'finalizado' => 'boolean',
        'finalizado_em' => 'datetime'
    ];
}
>>>>>>> 5a9bdc5dcce23c3512fe3f63dd48103d065a809a
