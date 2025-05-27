<a {{ $attributes->merge([
    'class' => 'block w-full px-4 py-2 text-start text-sm leading-5 transition duration-150 ease-in-out',
    'style' => 'color: black; background-color: #ffffff;',
    'onmouseover' => "this.style.backgroundColor='#FFCC6D'",
    'onmouseout' => "this.style.backgroundColor='#ffffff'",
    'onfocus' => "this.style.backgroundColor='#FFCC6D'",
    'onblur' => "this.style.backgroundColor='#FFCC6D'"
]) }}>{{ $slot }}</a>
