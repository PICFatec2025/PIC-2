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
}
