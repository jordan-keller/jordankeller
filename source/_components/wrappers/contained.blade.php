@props([
    'maxWidth' => 'max-w-4xl',
    'padding' => true,
    'as' => 'div',
])

@php
    $paddingClasses = $padding ? 'px-4 sm:px-6 lg:px-8' : '';
    $class = "mx-auto {$maxWidth} {$paddingClasses}";
@endphp

<{{ $as }} {{ $attributes->merge(['class' => $class]) }}>
    {{ $slot }}
</{{ $as }}>
