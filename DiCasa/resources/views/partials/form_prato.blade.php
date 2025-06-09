{{-- partials/form_prato.blade.php --}}

@props([
    'values' => [],
    'selected' => [],
    '$textoDoBotao',
])

@php
    $diasSemana = [
        'terca_feira' => 'Terça-feira',
        'quarta_feira' => 'Quarta-feira',
        'quinta_feira' => 'Quinta-feira',
        'sexta_feira' => 'Sexta-feira',
        'sabado' => 'Sábado',
        'domingo' => 'Domingo'
    ];
@endphp

<div class="corpo">
    @include('partials.input_texto', [
        'name' => 'nome_prato',
        'nome_label' => 'Nome:',
        'placeholder' => 'Nome do Prato',
        'value' =>  $values['nome_prato'],
        'maxlength' => 50
    ])

    @include('partials.input_texto', [
        'name' => 'descricao',
        'nome_label' => 'Descrição:',
        'placeholder' => 'Descrição do Prato',
        'value' => $values['descricao'],
        'maxlength' => 200
    ])

    @include('partials.input_preco', [
        'name' => 'preco_p',
        'nome_label' => 'Preço P:',
        'placeholder' => 'Preço para o tamanho P',
        'value' =>  $values['preco_p'] 
    ])

    @include('partials.input_preco', [
        'name' => 'preco_m',
        'nome_label' => 'Preço M:',
        'placeholder' => 'Preço para o tamanho M',
        'value' =>  $values['preco_m']
    ])

    @include('partials.input_preco', [
        'name' => 'preco_g',
        'nome_label' => 'Preço G:',
        'placeholder' => 'Preço para o tamanho G',
        'value' =>  $values['preco_g']
    ])

    @include('partials.input_dias_semana', [
        'dias' => $diasSemana,
        'selected' =>  $selected
    ])

    <button type="submit" class="botaoAceitar">{{ $textoDoBotao }}</button>
</div>