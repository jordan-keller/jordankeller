@extends('_layouts.main')

@section('body')
    {{-- Theme-specific hero sections (hidden by default, shown by JS) --}}
    @foreach($page->themes as $themeKey => $themeConfig)
        <div class="hero-section mb-12 hidden" data-theme-hero="{{ $themeKey }}">
            @if(isset($themeConfig['hero']))
                <img src="{{ $themeConfig['hero']['image'] }}" 
                     alt="Hero image" 
                     class="w-full h-64 object-cover rounded mb-4">
                <h1 class="text-4xl font-bold mb-2">
                    {{ $themeConfig['hero']['heading'] }}
                </h1>
                <h2 class="text-2xl opacity-80">
                    {{ $themeConfig['hero']['subheading'] }}
                </h2>
            @endif
        </div>
    @endforeach

    {{-- Featured posts with category data attributes --}}
    @foreach ($posts->where('featured', true) as $featuredPost)
        <div class="post-item w-full mb-6" data-categories="{{ isset($featuredPost->categories) ? implode(',', (is_array($featuredPost->categories) ? $featuredPost->categories : $featuredPost->categories->toArray())) : '' }}">
            @if ($featuredPost->cover_image)
                <img src="{{ $featuredPost->cover_image }}" alt="{{ $featuredPost->title }} cover image" class="mb-6 max-h-96 w-full object-cover mix-blend-screen transition hover:mix-blend-normal rounded">
            @endif

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
                    <a href="{{ $featuredPost->getUrl() }}" title="Read - {{ $featuredPost->title }}" class="uppercase tracking-widest font-sans text-xs opacity-50 mb-4">
                        {{ ceil(str_word_count(strip_tags($featuredPost->getContent())) / 200) }} min read
                    </a>
                </span>

                <span class="text-right">
                    <a href="{{ $featuredPost->getUrl() }}" title="Read - {{ $featuredPost->title }}" class="uppercase tracking-wide mb-4 font-sans text-xs font-light tracking-widest">
                        Read <span class="tracking-tighter">>></span>
                    </a>
                </span>
            </div>
        </div>

        @if (! $loop->last)
            <hr class="border-b my-6 post-separator">
        @endif
    @endforeach

    @include('_components.newsletter-signup')

    @foreach ($posts->where('featured', false)->take(6)->chunk(2) as $row)
        <div class="post-row flex flex-col md:flex-row md:-mx-6">
            @foreach ($row as $post)
                <div class="post-item w-full md:w-1/2 md:mx-6" data-categories="{{ isset($post->categories) ? implode(',', (is_array($post->categories) ? $post->categories : $post->categories->toArray())) : '' }}">
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

    {{-- DEBUG SCRIPT --}}
    <script>
        console.log('=== DEBUG INFO ===');
        console.log('window.themeConfig exists:', !!window.themeConfig);
        console.log('window.themeConfig:', window.themeConfig);
        console.log('Posts on page:', document.querySelectorAll('.post-item').length);
        document.querySelectorAll('.post-item').forEach((post, i) => {
            console.log(`Post ${i} categories:`, post.dataset.categories);
        });
        console.log('Heroes on page:', document.querySelectorAll('[data-theme-hero]').length);
        console.log('=== END DEBUG ===');
    </script>
@stop