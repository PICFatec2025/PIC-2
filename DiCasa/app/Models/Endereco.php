<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    use HasFactory;
    protected $fillable = [
        'logradouro',
        'bairro',
        'complemento',
        'cliente_id'
    ];
    public function cliente(){
        return $this->belongsTo(Cliente::class);
    }
}
