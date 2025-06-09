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

    protected $with = ['disponibilidade'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pedidoPrato()
    {
        return $this->hasMany(PedidoPrato::class);
    }

    public function disponibilidade()
    {
        return $this->hasOne(EstaDisponivel::class);
    }

    public function getDiasDisponiveisAttribute()
    {
        if (!$this->disponibilidade) {
            return [
                'terca_feira' => false,
                'quarta_feira' => false,
                'quinta_feira' => false,
                'sexta_feira' => false,
                'sabado' => false,
                'domingo' => false,
            ];
        }

        return [
            'terca_feira' => (bool) $this->disponibilidade->terca_feira,
            'quarta_feira' => (bool) $this->disponibilidade->quarta_feira,
            'quinta_feira' => (bool) $this->disponibilidade->quinta_feira,
            'sexta_feira' => (bool) $this->disponibilidade->sexta_feira,
            'sabado' => (bool) $this->disponibilidade->sabado,
            'domingo' => (bool) $this->disponibilidade->domingo,
        ];
    }

    public static function disponiveisHoje()
    {
        $dia = match (Carbon::now()->locale('pt_BR')->dayName) {
            'segunda-feira' => null,
            'terça-feira' => 'terca_feira',
            'quarta-feira' => 'quarta_feira',
            'quinta-feira' => 'quinta_feira',
            'sexta-feira' => 'sexta_feira',
            'sábado' => 'sabado',
            'domingo' => 'domingo',
            default => null,
        };

        if (!$dia) {
            return collect();
        }

        return self::whereHas('disponibilidade', function ($query) use ($dia) {
            $query->where($dia, true);
        })->get();
    }
}
