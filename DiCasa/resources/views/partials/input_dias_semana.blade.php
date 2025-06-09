@props([
    'name' => 'dias',
    'dias' => [],
    'selected' => [],
])

<label for="{{ $name }}">Disponível em: </label>

@foreach($dias as $key => $label)
    <div>
        <label>
            <input
                type="checkbox"
                name="{{ $name }}[{{ $key }}]"
                value="1"
                {{ old("$name.$key", $selected[$key] ?? false) ? 'checked' : '' }}
            >
            {{ $label }}
        </label>
    </div>
@endforeach