@extends('_layouts.main')

@section('body')

<div x-init="
    $nextTick(() => {
        filterPosts(theme);
        showHero(theme);
    });
">

{{-- Theme-specific hero sections --}}
@foreach($page->themes as $themeKey => $themeConfig)
    <div class="hero-section mb-12 hidden" data-theme-hero="{{ $themeKey }}">
        @if(isset($themeConfig['hero']))
            <span class="offset-x-10">
            <h1 class="text-7xl font-bold mb-2">{{ $themeConfig['hero']['heading'] }}</h1>
            <h2 class="text-3xl opacity-80">{{ $themeConfig['hero']['subheading'] }}</h2>
            </span>
        @endif
    </div>
@endforeach

{{-- Featured posts --}}
@foreach ($posts->where('featured', true) as $featuredPost)
    <div class="post-item w-full mb-6 bg-lime-900" 
         data-type="{{ $featuredPost->type ?? '' }}">
        
        @if ($featuredPost->cover_image)
            {{-- Your existing featured post with image layout --}}
            <div class="flex gap-6">
                <img src="{{ $featuredPost->cover_image }}" alt="{{ $featuredPost->title }} cover image" 
                     class="w-1/3 h-fit object-cover border-[var(--text)]/30 border-2">
                
                <div class="w-2/3">
                    {{-- all your existing content --}}
                    <p class="text-text opacity-80 font-medium my-2">
                        {{ $featuredPost->getDate()->format('F j, Y') }}
                    </p>

                    @if($featuredPost->type)
                        <div class="flex gap-2 mb-2">
                            <a href="{{ '/blog/types/' . strtolower(str_replace(' ', '-', $featuredPost->type)) }}" 
                               class="text-xs uppercase tracking-wider opacity-60 hover:opacity-100">
                                {{ $featuredPost->type }}
                            </a>
                        </div>
                    @endif

                    <h2 class="text-3xl mt-0">
                        <a href="{{ $featuredPost->getUrl() }}" title="Read {{ $featuredPost->title }}" class="text-link font-extrabold">
                            {{ $featuredPost->title }}
                        </a>
                    </h2>

                    <p class="mt-0 mb-4">{!! $featuredPost->getExcerpt() !!}</p>

                    <div class="grid grid-cols-2 gap-4 w-full">
                        <span class="w-1/2">
                            <a href="{{ $featuredPost->getUrl() }}" title="Read - {{ $featuredPost->title }}" 
                               class="uppercase tracking-widest font-sans text-xs opacity-50 mb-4">
                                {{ ceil(str_word_count(strip_tags($featuredPost->getContent())) / 200) }} min read
                            </a>
                        </span>
                        <span class="text-right">
                            <a href="{{ $featuredPost->getUrl() }}" title="Read - {{ $featuredPost->title }}" 
                               class="uppercase tracking-wide mb-4 font-sans text-xs font-light tracking-widest">
                                Read <span class="tracking-tighter">>></span>
                            </a>
                        </span>
                    </div>
                </div>
            </div>
        @else
            {{-- Your existing featured post without image layout --}}
        @endif
    </div>

    @if (! $loop->last)
        <hr class="border-b border-amber-900 my-6 post-separator">
    @endif
@endforeach

@include('_components.newsletter-signup')

{{-- Regular posts --}}
@foreach ($posts->where('featured', false)->take(9)->chunk(1) as $row)
    <div class="post-row flex flex-col md:flex-row border-b">
        @foreach ($row as $post)
            <div class="post-item w-full mb-6" 
                 data-type="{{ $post->type ?? '' }}">
                @include('_components.post-preview-inline', ['post' => $post])
            </div>

            @if (! $loop->last)
                <hr class="block md:hidden w-full border-l border-pink mt-2 mb-6 post-separator">
            @endif
        @endforeach
    </div>

    @if (! $loop->last)
        <hr class="w-full border-b border-yellow-400 mt-2 mb-6 post-separator">
    @endif
@endforeach

</div> 
@stop