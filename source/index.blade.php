@extends('_layouts.main')

@section('body')

@include('/intro')

@php
    $heroPost = $posts->first(fn ($p) => str_ends_with($p->getPath(), 'redshift-a-cross-on-a-gravel-road-music-video'));
    $secondPost = $posts->first(fn ($p) => str_ends_with($p->getPath(), 'charles-austin'));

    if (! $heroPost) {
        $heroPost = $posts->first();
    }
@endphp



<x-wrappers.contained>
    @foreach ($posts->where('type', 'writing') as $post)
        {{-- Your existing post loop --}}
    @endforeach
</x-wrappers.contained>

@stop
