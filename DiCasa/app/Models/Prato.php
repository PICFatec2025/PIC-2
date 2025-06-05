<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prato extends Model
{
    use HasFactory;
    protected $fillable = [
        'nome_prato',
        'descricao',
        'preco_p',
        'preco_m',
        'preco_g',
        'cliente_id'
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
     public function pedidoPrato(){
        return $this->hasMany(PedidoPrato::class);
    }
       function preco_convertido_p(): string
    {
        return "R$: " . number_format($this->preco_p, 2, ",",".");
    }
         function preco_convertido_m(): string
    {
        return "R$: " . number_format($this->preco_m, 2, ",",".");
    }
         function preco_convertido_g(): string
    {
        return "R$: " . number_format($this->preco_g, 2, ",",".");
    }
}
