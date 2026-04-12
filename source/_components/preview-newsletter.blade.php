<a
    href="{{ '/' . ltrim($post->getPath(), '/') }}"
    title="Read - {{ $post->title }}"
    class="text-[var(--text)] no-underline opacity-90 transition duration-200 hover:translate-x-1 hover:-translate-y-1 hover:text-[var(--text)]/100 hover:opacity-100"
>
    <div class="my-1 flex w-full flex-col bg-[var(--bg)]/15">
        <span class="flex flex-col gap-1.5 px-4 pt-3 pb-2">
            @if ($post->category)
                <p
                    class="my-0 font-mono text-[0.65rem] font-thin tracking-[0.22em] text-[var(--text)]/60 uppercase opacity-60"
                >
                    {{ $page->getTypeLabel($post->category) }}
                </p>
            @endif

            <h2 class="vhs-glow font-heading mt-0 mb-0 text-2xl text-balance text-[var(--link)]">
                {!! $post->title !!}
            </h3>

            <p class="font-body mt-0 mb-0 leading-relaxed">{!! $post->description !!}</p>
        </span>

        <span
            class="mt-auto flex items-center justify-between border-t border-white/5 px-4 py-2 text-[0.65rem] tracking-[0.22em] uppercase"
        >
            <span class="font-mono opacity-60">
                {{ $post->getDate()->format('Y-m-d') }}
                • {{ ceil(str_word_count(strip_tags($post->getContent())) / 200) }} min read
            </span>
            <span
                class="font-sans text-[var(--link)] opacity-80 transition-opacity duration-300 ease-in-out group-hover:opacity-100"
            >
                {!! $post->readmore !!}
                <span class="text-xs tracking-tight">>></span>
            </span>
        </span>
    </div>
</a>
