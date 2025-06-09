@props([
    'values' => [],
    $mascara
])
<div class="corpo">
    @include('partials.input_texto', [
        'name' => 'nome',
        'nome_label' => 'Nome:',
        'placeholder' => 'Nome do Cliente',
        'value' =>  $values['nome_cliente'],
        'maxlength' => 50
    ])
    @include('partials.input_texto', [
        'name' => 'lograduro',
        'nome_label' => 'Logradouro:',
        'placeholder' => 'Endereço do cliente (av, rua, alameda e etc..)',
        'value' =>  $values['logradouro_cliente'],
        'maxlength' => 150
    ])
    @include('partials.input_texto', [
        'name' => 'bairro',
        'nome_label' => 'Bairro:',
        'placeholder' => 'Bairro do cliente (opcional)',
        'value' =>  $values['bairro_cliente'],
        'maxlength' => 50
    ])
    @include('partials.input_texto', [
        'name' => 'complemento',
        'nome_label' => 'Complemento:',
        'placeholder' => 'Complemento do endereço do cliente (opcional)',
        'value' =>  $values['complemento_cliente'],
        'maxlength' => 30
    ])
    @include('partials.input_telefone', [
        'name' => 'telefone',
        'label' => 'Telefone:',
        'placeholder' => 'Telefone com ddd (opcional)',
        'value' => $values['telefone_cliente'],
        'required' => false
    ])
</div>
