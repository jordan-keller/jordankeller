@extends('_layouts.main')

@section('body')

<div
    id="watch-slider"
    class="relative w-screen overflow-x-hidden"
    style="height: calc(100vh - 6rem)"
    x-data="{
        current: 0,
        total: {{ $posts->where('type', 'video')->count() }},
        next() { if (this.current < this.total - 1) this.current++ },
        prev() { if (this.current > 0) this.current-- },
        goto(i) { this.current = i },
    }"
    @keydown.arrow-right.window="next()"
    @keydown.arrow-left.window="prev()"
    @wheel.window.prevent="$event.deltaY > 0 || $event.deltaX > 0 ? next() : prev()"
>
    {{-- Slides Track --}}
    <div
        class="flex h-full transition-transform duration-500 ease-in-out"
        :style="`transform: translateX(-${current * 100}vw)`"
    >
        @foreach ($posts->where('type', 'video') as $post)
            <div
                class="relative flex h-full w-screen shrink-0 flex-col items-start justify-end"
                style="min-width: 100vw"
                x-data="{ playing: false }"
            >
                {{-- Full-bleed background image --}}
                @if ($post->cover_image)
                    <div
                        x-show="!playing"
                        class="absolute inset-0 bg-cover bg-center"
                        style="background-image: url('/{{ $post->cover_image }}')"
                    ></div>
                @endif

                {{-- Gradient overlay --}}
                <div
                    x-show="!playing"
                    class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/40 to-black/10"
                ></div>

                {{-- Inline video — src only set when playing to prevent autoplay on load --}}
                @if ($post->featured_video)
                    <div x-show="playing" x-cloak class="absolute inset-0 bg-black">
                        <iframe
                            :src="playing ? '{{ $post->featured_video }}?autoplay=1' : ''"
                            class="h-full w-full"
                            frameborder="0"
                            allow="autoplay; fullscreen"
                            allowfullscreen
                        ></iframe>
                    </div>
                @endif

                {{-- Content --}}
                <div x-show="!playing" class="relative z-10 w-full max-w-3xl px-8 pb-16 lg:px-16 lg:pb-20">
                    @if ($post->category)
                        <p class="mb-3 font-mono text-[0.65rem] tracking-[0.22em] text-white/50 uppercase">
                            {{ $page->getTypeLabel($post->category) }}
                        </p>
                    @endif

                    <h2 class="mb-3 font-mono text-2xl font-bold tracking-wide text-white lg:text-4xl">
                        {!! $post->title !!}
                    </h2>

                    @if ($post->description)
                        <p class="mb-6 font-mono text-sm leading-relaxed text-white/70 lg:text-base">
                            {!! $post->description !!}
                        </p>
                    @endif

                    <div class="flex items-center gap-4">
    @if ($post->featured_video)
        <button
            @click.stop="playing = true"
            style="background: transparent; color: white;"
            class="inline-block border border-white/40 px-5 py-2 font-mono text-[0.65rem] tracking-[0.22em] uppercase transition-colors duration-200 hover:border-white hover:text-white"
        >
            Watch &rarr;
        </button>
    @elseif ($post->readmore)
        
            href="{{ '/' . ltrim($post->getPath(), '/') }}"
            style="color: rgba(255,255,255,0.5); text-decoration: none;"
            class="inline-block border border-white/20 px-5 py-2 font-mono text-[0.65rem] tracking-[0.22em] uppercase transition-colors duration-200 hover:border-white/60 hover:text-white/80"
        >
            {{ $post->readmore }} &rarr;
        </a>
    @endif
</div>

                    <p class="mt-4 font-mono text-[0.65rem] tracking-[0.22em] text-white/30 uppercase">
                        {{ $post->getDate()->format('Y-m-d') }}
                    </p>
                </div>

                {{-- Close video button --}}
                @if ($post->featured_video)
                    <button
                        x-show="playing"
                        x-cloak
                        @click.stop="playing = false"
                        class="absolute top-4 right-4 z-30 p-2 font-mono text-white/50 transition-colors duration-200 hover:text-white focus:outline-none"
                        aria-label="Close video"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                @endif
            </div>
        @endforeach
    </div>

    {{-- Prev / Next arrows --}}
    <button
        @click="prev()"
        x-show="current > 0"
        x-cloak
        style="background: transparent;"
        class="absolute top-1/2 left-4 z-20 -translate-y-1/2 p-2 text-white/50 transition-colors duration-200 hover:text-white focus:outline-none"
        aria-label="Previous"
    >
        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
        </svg>
    </button>

    <button
        @click="next()"
        x-show="current < total - 1"
        x-cloak
        style="background: transparent;"
        class="absolute top-1/2 right-4 z-20 -translate-y-1/2 p-2 text-white/50 transition-colors duration-200 hover:text-white focus:outline-none"
        aria-label="Next"
    >
        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
        </svg>
    </button>

    {{-- Slide counter --}}
    <div class="absolute right-8 bottom-6 z-20 font-mono text-[0.65rem] tracking-[0.22em] text-white/30 uppercase">
        <span x-text="current + 1"></span> / {{ $posts->where('type', 'video')->count() }}
    </div>

    {{-- Dot navigation --}}
    <div class="absolute bottom-6 left-1/2 z-20 flex -translate-x-1/2 gap-2">
        @foreach ($posts->where('type', 'video') as $i => $post)
            <button
                @click="goto({{ $loop->index }})"
                style="background: transparent;"
                class="h-1 w-6 transition-all duration-300 focus:outline-none"
                :class="current === {{ $loop->index }} ? 'bg-white' : 'bg-white/30'"
                aria-label="Go to slide {{ $loop->index + 1 }}"
            ></button>
        @endforeach
    </div>
</div>

@stop