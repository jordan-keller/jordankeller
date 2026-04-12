@extends('_layouts.main')

@section('body')
    <x-wrappers.contained>
        {{-- Breadcrumb --}}
        @if ($page->type)
            <p class="font-mono text-xs tracking-wider uppercase opacity-60">
                <a href="/{{ $page->type }}">
                    {{ ucwords(str_replace('-', ' ', $page->type)) }}
                </a>
                @if ($page->category)
                    /
                    <a href="/{{ $page->type }}/{{ $page->category }}">
                        {{ ucwords(str_replace('-', ' ', $page->category)) }}
                    </a>
                @endif
            </p>
        @endif

        {{-- Title + Description + Utility Metadata --}}
        <div class="flex flex-col gap-3">
            <h1 class="vhs-glow text-6xl leading-none text-balance md:text-7xl lg:text-7xl">
                {!! $page->title !!}
            </h1>
            <div class="max-w-5/6 font-[heading] text-2xl leading-none font-normal">
                {!! $page->description !!}
            </div>
            <p class="font-mono text-xs tracking-wider uppercase opacity-50">
                {{ date('F j, Y', $page->date) }} &middot; {{ number_format($page->word_count($page)) }} words
            </p>
        </div>

        {{-- Media --}}

        @if ($page->featured_video)
            <div class="youtube-embed">
                <iframe
                    src="{{ $page->featured_video }}"
                    class="youtube-iframe"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen
                    loading="lazy"
                ></iframe>
            </div>
        @elseif ($page->cover_image)
            <img src="/{{ $page->cover_image }}" alt="{{ $page->title }} cover image" />
        @endif

        {{-- Byline --}}
        @if ($page->author)
            <p class="mt-4 font-mono text-xs tracking-wider uppercase opacity-60">By {{ $page->author }}</p>
        @endif

        {{-- Content --}}
        <div class="border-link gap-10 border-b pb-10">
            @yield('content')
        </div>

        {{-- Prev/Next Nav --}}
        <nav class="mt-3 grid grid-cols-2 gap-4 text-sm md:text-base">
            <div class="flex justify-start">
                @if ($next = $page->getNext())
                    <a href="{{ '/' . ltrim($next->getPath(), '/') }}" title="Older Post: {{ $next->title }}">
                        &larr; {!! $next->title !!}
                    </a>
                @endif
            </div>
            <div class="flex justify-end text-right">
                @if ($previous = $page->getPrevious())
                    <a href="{{ '/' . ltrim($previous->getPath(), '/') }}" title="Newer Post: {{ $previous->title }}">
                        {!! $previous->title !!} &rarr;
                    </a>
                @endif
            </div>
        </nav>
    </x-wrappers.contained>
@endsection
