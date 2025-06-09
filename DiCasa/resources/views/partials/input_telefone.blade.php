@props([
    'name' => 'telefone',
    'label' => 'Telefone',
    'value' => '',
    'placeholder' => '(99) 99999-9999',

])

<div class="linha1">
    <label for="{{ $name }}">{{ $label }}</label>
    <input
        type="text"
        name="{{ $name }}"
        id="{{ $name }}"
        class="campo-input"
        value="{{ $value }}"
        placeholder="{{ $placeholder }}"
        data-mask="(99) 99999-9999"
        maxlength="14"
    />
</div>