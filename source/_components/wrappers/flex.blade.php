<!-- prettier-ignore-start -->
@props([
    'direction' => 'row',
    'justify' => 'start',
    'align' => 'start',
    'wrap' => true,
    'as' => 'div',
])
<!-- prettier-ignore-end -->

@php
    $directionClass = match ($direction) {
        'col' => 'flex-col',
        'row-reverse' => 'flex-row-reverse',
        'col-reverse' => 'flex-col-reverse',
        default => 'flex-row',
    };

    $justifyClass = match ($justify) {
        'end' => 'justify-end',
        'center' => 'justify-center',
        'between' => 'justify-between',
        'around' => 'justify-around',
        'evenly' => 'justify-evenly',
        default => 'justify-start',
    };

    $alignClass = match ($align) {
        'end' => 'items-end',
        'center' => 'items-center',
        'stretch' => 'items-stretch',
        'baseline' => 'items-baseline',
        default => 'items-start',
    };

    $wrapClass = $wrap ? 'flex-wrap' : 'flex-nowrap';
@endphp

<{{ $as }} {{ $attributes->merge(['class' => "flex {$directionClass} {$justifyClass} {$alignClass} {$wrapClass}"]) }}>
    {{ $slot }}
</{{ $as }}>