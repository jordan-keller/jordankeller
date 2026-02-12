@extends('_layouts.main')

@php
    $page->type = 'article';
@endphp

@section('body')

    @if ($page->categories)
        @foreach ($page->categories as $i => $category)
            <a
                href="{{ '/blog/categories/' . $category }}"
                title="View posts in {{ $category }}"
                class="inline-block tracking-wider uppercase text-xs font-sans font-light opacity-70"
            >{{ $category }}</a>
        @endforeach
    @endif

    <h1 class="leading-none mb-2">{{ $page->title }}</h1>
    <div class="leading-none mb-2 text-2xl font-normal font-[heading]">{{ $page->description }}</div>

        @if ($page->cover_image)
            <img src="../{{ $page->cover_image }}" alt="{{ $page->title }} cover image" class="mb-2">
        @endif

    <p class="text-text font-sans text-xs md:mt-0 opacity-70">{{ $page->author }}  /  {{ date('F j, Y', $page->date) }}</p>


    <div class="border-b border-link mb-10 pb-4">
        @yield('content')
    </div>

    <nav class="flex justify-between text-sm md:text-base">
        <div>
            @if ($next = $page->getNext())
                <a href="{{ $next->getUrl() }}" title="Older Post: {{ $next->title }}">
                    &LeftArrow; {{ $next->title }}
                </a>
            @endif
        </div>

        <div>
            @if ($previous = $page->getPrevious())
                <a href="{{ $previous->getUrl() }}" title="Newer Post: {{ $previous->title }}">
                    {{ $previous->title }} &RightArrow;
                </a>
            @endif
        </div>
    </nav>
@endsection
