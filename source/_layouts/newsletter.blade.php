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

        {{-- Title + Description --}}
        <div class="flex flex-col gap-2">
            <span class="font-mono text-xs tracking-wider uppercase">Issue {!! $page->issue !!}</span>
            <h1 class="vhs-glow text-6xl leading-none text-balance md:text-7xl lg:text-7xl">
                {!! $page->title !!}
            </h1>
            <div class="mb-10 max-w-5/6 font-[heading] text-2xl leading-none font-normal">
                {!! $page->description !!}
            </div>
        </div>

        {{-- Media + Byline grouped --}}
        <div class="flex flex-col gap-0">
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

            <p class="text-text font-sans text-xs opacity-70">
                {{ $page->author }} / {{ date('F j, Y', $page->date) }}
            </p>
        </div>

        {{-- Content --}}
        <div class="border-link gap-10 border-b pb-10">
            @yield('content')
        </div>

        {{-- Referenced Posts --}}
        @if ($page->posts)
            <div class="flex flex-col gap-6">
                @foreach ($page->posts as $slug)
                    @php
                        $post = $posts->filter(fn ($p) => $p->getFilename() === $slug)->first();
                    @endphp

                    @if ($post)
                        <div>
                            @if ($post->cover_image)
                                <img src="{{ $post->cover_image }}" alt="{{ $post->title }}" />
                            @endif

                            <h2>{{ $post->title }}</h2>
                            <p>{!! $post->getExcerpt() !!}</p>
                            <a href="/{{ $post->getPath() }}">{{ $post->readmore ?? 'Read more' }}</a>
                        </div>
                    @endif
                @endforeach
            </div>
        @endif

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
