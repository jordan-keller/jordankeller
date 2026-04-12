@props(['as' => 'section'])

<{{ $as }} {{ $attributes->merge(['class' => 'w-full']) }}>
    {{ $slot }}
</{{ $as }}>
