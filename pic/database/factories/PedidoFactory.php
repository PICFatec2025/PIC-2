<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PedidoFactory extends Factory
{
    public function definition()
    {
        $clientes = [
            'João Silva', 'Maria Oliveira', 'Carlos Souza', 'Ana Santos', 
            'Pedro Costa', 'Lucia Ferreira', 'Marcos Ribeiro', 'Julia Almeida'
        ];

        $pedidos = [
            'Pizza Margherita', 'Hambúrguer Artesanal', 'Frango Assado', 
            'Lasanha à Bolonhesa', 'Salada Caesar', 'Sushi Variado', 
            'Risoto de Cogumelos', 'Filé Mignon', 'Macarrão Carbonara'
        ];

        $horas = [
            '12:30', '13:15', '14:00', '18:30', '19:15', '20:45', 
            '12:45', '13:30', '19:00', '20:30'
        ];

        return [
            'nome_cliente' => $this->faker->randomElement($clientes),
            'pedido' => $this->faker->randomElement($pedidos),
            'hora' => $this->faker->randomElement($horas),
            'tipo' => $this->faker->randomElement(['Entrega', 'Retirada']),
            'produzindo' => false,  // Todos começam como false
            'pronto' => false,      // Todos começam como false
            'entregue' => false     // Todos começam como false
        ];
    }
}