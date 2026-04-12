@extends('_layouts.main')

@section('body')
<div class="max-w-2xl mx-auto px-6 py-16">

  <h1 class="text-3xl font-bold mb-10">Tags</h1>

  @php
    $tagCounts = collect();

    foreach ($posts as $post) {
    $tags = $post->tags;
    if (!$tags) continue;

    if (is_array($tags)) {
        $tagList = $tags;
    } elseif (is_string($tags)) {
        $tagList = preg_split('/\s*,\s*/', $tags);
    } else {
        $tagList = $tags->toArray();
    }

    foreach ($tagList as $tag) {
        $tag = trim($tag);
        if (!$tag) continue;
        $tagCounts[$tag] = ($tagCounts[$tag] ?? 0) + 1;
    }
  }

    $tagCounts = $tagCounts->sortKeys();
  @endphp

  <div class="flex gap-4 mb-8 text-sm font-medium">
    <button id="sort-alpha" onclick="sortTags('alpha')" class="transition-colors">A–Z</button>
    <button id="sort-count" onclick="sortTags('count')" class="text-gray-400 hover:text-gray-600 transition-colors">By count</button>
  </div>

  <ul id="tag-list" class="divide-y divide-gray-200">
    @foreach ($tagCounts as $tag => $count)
      <li class="py-3 flex justify-between items-center"
          data-tag="{{ $tag }}"
          data-count="{{ $count }}">
        <a href="/tags/{{ $tag }}" class="hover:text-blue-600 transition-colors">{{ $tag }}</a>
        <span class="text-sm text-gray-400">{{ $count }} {{ \Illuminate\Support\Str::plural('post', $count) }}</span>
      </li>
    @endforeach
  </ul>

</div>

<script>
  function sortTags(mode) {
    const list = document.getElementById('tag-list');
    const items = Array.from(list.querySelectorAll('li'));

    items.sort((a, b) => {
      if (mode === 'alpha') {
        return a.dataset.tag.localeCompare(b.dataset.tag);
      } else {
        return parseInt(b.dataset.count) - parseInt(a.dataset.count);
      }
    });

    items.forEach(item => list.appendChild(item));

    document.getElementById('sort-alpha').className = mode === 'alpha'
      ? 'transition-colors'
      : 'text-gray-400 hover:text-gray-600 transition-colors';

    document.getElementById('sort-count').className = mode === 'count'
      ? 'transition-colors'
      : 'text-gray-400 hover:text-gray-600 transition-colors';
  }
</script>

@endsection