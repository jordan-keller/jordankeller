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

    {{-- Featured posts - FIXED data-categories --}}
    {{-- Featured posts - FIXED data-categories --}}
@foreach ($posts->where('featured', true) as $featuredPost)
    <div class="post-item w-full mb-6" 
         data-categories="{{ $featuredPost->categories ? implode(',', $featuredPost->categories) : '' }}">
        
        @if ($featuredPost->cover_image)
            {{-- Layout with image: 1/3 image, 2/3 content --}}
            <div class="flex gap-6">
                <img src="{{ $featuredPost->cover_image }}" alt="{{ $featuredPost->title }} cover image" 
                     class="w-1/3 h-fit object-cover border-[var(--text)]/30 border-2">
                
                <div class="w-2/3">
                    <p class="text-text opacity-60 font-medium my-2">
                        {{ $featuredPost->getDate()->format('F j, Y') }}
                    </p>

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
            {{-- Layout without image: full width --}}
            <p class="text-text opacity-60 font-medium my-2">
                {{ $featuredPost->getDate()->format('F j, Y') }}
            </p>

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
        @endif
    </div>

    @if (! $loop->last)
        <hr class="border-b my-6 post-separator">
    @endif
@endforeach

    @include('_components.newsletter-signup')

    {{-- Regular posts - FIXED data-categories --}}
    @foreach ($posts->where('featured', false)->take(6)->chunk(2) as $row)
        <div class="post-row flex flex-col md:flex-row md:-mx-6">
            @foreach ($row as $post)
                <div class="post-item w-full md:w-1/2 md:mx-6" 
                     data-categories="{{ $post->categories ? implode(',', $post->categories) : '' }}">
                    @include('_components.post-preview-inline')
                </div>

                @if (! $loop->last)
                    <hr class="block md:hidden w-full border-b mt-2 mb-6">
                @endif
            @endforeach
        </div>

        @if (! $loop->last)
            <hr class="w-full border-b mt-2 mb-6 post-separator">
        @endif
    @endforeach

</div> 
@stop
