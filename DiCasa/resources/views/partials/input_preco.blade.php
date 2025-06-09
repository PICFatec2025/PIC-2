@props([
    'name',
    'nome_label',
    'placeholder' => '',
    'value' => '',
])
<div class="linha1">
    <label for="{{ $name }}">{{ $nome_label }} </label>
    <input type="number" step="0.01" name="{{ $name }}" class="campo-input" placeholder="{{ $placeholder }}"
        inputmode="decimal" value="{{ $value }}">
</div>