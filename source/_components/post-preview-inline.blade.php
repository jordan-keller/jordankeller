<div class="flex flex-col mb-4 bg-pink-900">

    @if(isset($post->categories) && !empty($post->categories))
        <div class="flex gap-2 mb-2">
            @foreach ($post->categories as $category)
                <a href="{{ '/blog/categories/' . $category }}"
                   class="no-underline text-xs uppercase tracking-wider opacity-60 hover:opacity-70">
                    {{ ucwords(str_replace('-', ' ', $category)) }}
                </a>
            @endforeach
        </div>
    @endif
    
    <h2 class="text-3xl mt-0">
        
            <a href="{{ $post->getUrl() }}"
            title="Read more - {{ $post->title }}"
            class="text-link font-extrabold"
        >{{ $post->title }}</a>
    </h2>

    <p class="mb-4 mt-0">{!! $post->description !!}</p>

    
        <a href="{{ $post->getUrl() }}"
        title="Read more - {{ $post->title }}"
        class="uppercase font-normal tracking-wide mb-4 font-sans text-xs opacity-50 tracking-widest"
    >Read <span class="tracking-tighter">>></span></a>
</div>