@extends('_layouts.main')

@section('body')

<x-wrappers.contained>
    @foreach ($posts->where('featured', true) as $post)
        @include('_components.post-preview-featured', ['post' => $post])
        @if (! $loop->last)
            <hr class="post-separator my-3 opacity-0" />
        @endif
    @endforeach

    @foreach ($posts->where('featured', false)->take(9) as $post)
        <div class="post-item w-full" data-type="{{ $post->type }}">
            @include('_components.post-preview-inline', ['post' => $post])
        </div>
    @endforeach
</x-wrappers.contained>

@stop
