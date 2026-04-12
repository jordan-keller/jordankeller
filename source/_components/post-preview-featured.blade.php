<div
    class="post-item gap- flex w-full flex-col bg-[var(--bg)]/20 transition duration-300 ease-in-out hover:bg-[var(--bg)]/30 md:mx-auto lg:flex-row"
>
    <span class="w-full shrink-0 lg:w-full">
        @if ($post->cover_image)
            <img
                src="{{ $post->cover_image }}"
                alt="{{ $post->title }} cover image"
                class="h-full w-full object-cover"
            />
        @endif
    </span>

    <div class="flex flex-1 flex-col lg:p-2 lg:pt-1.5">
        <span class="flex flex-col gap-1.5 px-4 pt-3 pb-2">
            @if ($post->category)
                <span
                    class="font-mono text-[0.75rem] font-thin tracking-[0.22em] text-[var(--text)]/60 uppercase opacity-80"
                >
                    {{ $page->getTypeLabel($post->category) }}
                </span>
            @endif

            <h2 class="mt-0 text-[3rem] leading-tight text-balance">
                <a
                    href="{{ '/' . ltrim($post->getPath(), '/') }}"
                    title="Read {{ $post->title }}"
                    class="text-link vhs-glow font-extrabold opacity-85"
                >
                    {!! $post->title !!}
                </a>
            </h2>

            <p class="mt-2 mb-0 text-[1rem] leading-tight">
                {!! $post->description !!}
            </p>
        </span>

        <span
            class="mt-auto flex items-center justify-between border-t border-white/5 px-4 py-2 text-[0.65rem] tracking-[0.22em] uppercase"
        >
            <span class="font-mono opacity-60">
                {{ $post->getDate()->format('F j, Y') }}
                • {{ ceil(str_word_count(strip_tags($post->getContent())) / 200) }} min read
            </span>
            <a
                href="{{ '/' . ltrim($post->getPath(), '/') }}"
                title="Read - {{ $post->title }}"
                class="font-sans no-underline decoration-[var(--link)] opacity-80 transition-opacity duration-300 ease-in-out hover:underline hover:opacity-100"
            >
                <span
                    class="font-sans text-[var(--link)] opacity-80 transition-opacity duration-300 ease-in-out group-hover:opacity-100"
                >
                    {!! $post->readmore !!}
                    <span class="text-xs tracking-tight">>></span>
                </span>
            </a>
        </span>
    </div>
</div>
