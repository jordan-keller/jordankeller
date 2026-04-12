@extends('_layouts.main')

@section('body')

<div class="max-w-2xl mx-auto px-6 py-16">

  <div class="mb-10">
    <a href="/tags" class="text-sm text-gray-400 hover:text-gray-600 transition-colors">← All tags</a>
    <h1 class="text-3xl font-bold mt-3 mb-1">{{ $page->tag }}</h1>
    <p class="text-gray-500">
      {{ $page->filteredPosts($posts)->count() }}
    </p>
  </div>

  <div class="divide-y divide-gray-200">
    @forelse ($page->filteredPosts($posts) as $post)
      <article class="py-5">
        <a href="{{ $post->getUrl() }}" class="group block">
          <h2 class="text-lg font-semibold group-hover:text-blue-600 transition-colors leading-snug">
            {!! $post->title !!}
          </h2>
          @if ($post->description)
            <p class="text-sm text-gray-500 mt-1 line-clamp-2">{{ $post->description }}</p>
          @endif
          <p class="text-xs text-gray-400 mt-2">{{ date('F j, Y', $post->date) }}</p>
        </a>
      </article>
    @empty
      <p class="text-gray-400 py-6">No posts found for this tag.</p>
    @endforelse
  </div>

</div>

@endsection