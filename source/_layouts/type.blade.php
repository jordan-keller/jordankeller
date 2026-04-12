@extends('_layouts.main')

@section('body')
    <x-wrappers.contained>
        @php
            $filteredPosts = $posts
                ->filter(function ($post) use ($page) {
                    if ($page->getFilename() === 'feature') {
                        return $post->featured === true;
                    }
                    if ($page->category) {
                        return $post->type === $page->type && $post->category === $page->category;
                    }
                    return $post->type === $page->getFilename();
                })
                ->sortByDesc('featured');
        @endphp

        @forelse ($filteredPosts as $post)
            @if ($post->featured)
                @include('_components.post-preview-featured', ['post' => $post])
            @else
                @include('_components.post-preview-inline', ['post' => $post])
            @endif
        @empty
            <p class="opacity-60">No posts yet.</p>
        @endforelse
    </x-wrappers.contained>
@endsection
