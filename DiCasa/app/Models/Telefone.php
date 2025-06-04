<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Telefone extends Model
{
    protected $fillable=[
        'telefone',
        'cliente_id'
    ];
    public function cliente(){
        return $this->belongsTo(Cliente::class);
    }
}
