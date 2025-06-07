<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstaDisponivel extends Model
{
    use HasFactory;

    protected $table = 'esta_disponiveis';
    protected $fillable = [
        'terca_feira',
        'quarta_feira',
        'quinta_feira',
        'sexta_feira',
        'sabado',
        'domingo',
        'pedido_id'
    ];
    public function prato(){
        return $this->belongsTo(Prato::class);
    }
}
