@props([
    'cols' => 1, // Default columns
    'gap' => 'gap-6', // Spacing between grid items
    'as' => 'div',
])

@php
    $gridCols = match ($cols) {
        2 => 'grid-cols-1 sm:grid-cols-2',
        3 => 'grid-cols-1 sm:grid-cols-2 lg:grid-cols-3',
        4 => 'grid-cols-1 sm:grid-cols-2 lg:grid-cols-4',
        default => 'grid-cols-1',
    };
@endphp

<{{ $as }} {{ $attributes->merge(['class' => "grid {$gridCols} {$gap}"]) }}>
    {{ $slot }}
</{{ $as }}>
