@props([
    'name',
    'nome_label',
    'placeholder' => '',
    'value' => '',
    'maxlength' => null,
    'mascara' => null,
])
<div class="linha1">
    <label for="{{ $name }}">{{ $nome_label }}</label>
    <input
        type="text"
        name="{{ $name }}"
        class="campo-input"
        placeholder="{{ $placeholder }}"
        value="{{ $value }}"
        @if($maxlength) maxlength="{{ $maxlength }}" @endif
        @if($mascara) data-mask="{{ $mascara }}" @endif
    />
</div>