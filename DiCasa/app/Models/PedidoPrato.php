<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PedidoPrato extends Model
{   
    use HasFactory;
    protected $fillable = [
        'prato_id',
        'pedido_id',
        'tamanho',
        'tamanho',
        'preco',
        'quantidade'
    ];
    public function prato(){
        return $this->belongsTo(Prato::class);
    }
    public function pedido(){
        return $this->belongsTo(Pedido::class);
    }

}
