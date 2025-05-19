<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendas extends Model
{
    use HasFactory;
    protected $fillable = [
        'nome',
        'pedido',
        'preco'
    ];
    function preco_convertido(): string
    {
        return "R$: " . number_format($this->preco, 2, ",",".");
    }
}
