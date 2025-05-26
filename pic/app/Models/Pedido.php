<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
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