<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable= [
        'nome',
        'user_id',
    ] ;
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function enderecos(){
        return $this->hasMany(Endereco::class);
    }
    public function telefones(){
        return $this->hasMany(Telefone::class);
    }
    public function pedidos(){
        return $this->hasMany(Pedido::class);
    }
}
