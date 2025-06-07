<?php

namespace App\Models;

use Carbon\Carbon;
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
    public function estaDisponivel(){
        return $this->hasOne(EstaDisponivel::class);
    }
    public static function disponiveisHoje()
{
    $dia = match (Carbon::now()->locale('pt_BR')->dayName) {
        'segunda-feira' => null, // não tem no banco
        'terça-feira'   => 'terca_feira',
        'quarta-feira'  => 'quarta_feira',
        'quinta-feira'  => 'quinta_feira',
        'sexta-feira'   => 'sexta_feira',
        'sábado'        => 'sabado',
        'domingo'       => 'domingo',
        default         => null,
    };

    if (!$dia) {
        return collect(); // retorna vazio caso seja segunda-feira ou erro
    }

    return self::whereHas('disponibilidade', function ($query) use ($dia) {
        $query->where($dia, true);
    })->get();
}
}
