@props(['active'])

@php
$classes = $active
            ? 'inline-flex items-center px-1 pt-1 justify-center text-white nav-link-dicasa route-' . Route::currentRouteName() . ' text-sm font-medium leading-5   focus:outline-none  transition duration-150 ease-in-out'
            : 'inline-flex items-center px-1 pt-1 justify-center  nav-link-dicasa text-sm font-medium leading-5   hover: -700 dark:hover: -300   focus:outline-none focus: -700 dark:focus: -300  transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
