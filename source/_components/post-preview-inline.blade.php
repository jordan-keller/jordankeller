<x-wrappers.contained>
    <a
        href="{{ '/' . ltrim($post->getPath(), '/') }}"
        title="Read - {!! $post->title !!}"
        class="text-[var(--text)] no-underline opacity-90 transition duration-200 hover:opacity-100"
    >
        <div class="mx-auto my-0 flex flex-col py-0">
            <div class="flex items-start justify-between gap-4">
                @if ($post->cover_image)
                    <div class="shrink-0">
                        <img
                            src="/{{ $post->cover_image }}"
                            alt="{{ $post->title }} cover image"
                            class="h-48 max-h-64 w-48 max-w-64 object-cover"
                        />
                    </div>
                @endif

                <div class="flex flex-1 flex-col gap-1">
                    @if ($post->category)
                        <p class="my-0 font-mono text-[0.65rem] tracking-[0.22em] text-[var(--text)]/60 uppercase">
                            {{ $page->getTypeLabel($post->category) }}
                        </p>
                    @endif

                    <h3 class="mt-0 mb-0 font-mono text-base font-bold tracking-wide text-[var(--text)]">
                        {!! $post->title !!}
                    </h3>
                    @if ($post->description)
                        <p class="mt-1 mb-0 font-mono text-sm leading-relaxed text-[var(--text)]/60">
                            {!! $post->description !!}
                        </p>
                    @endif
                </div>

                <span
                    class="shrink-0 text-right font-mono text-[0.65rem] tracking-[0.22em] text-[var(--text)]/60 uppercase"
                >
                    <span class="block">{{ $post->getDate()->format('Y-m-d') }}</span>
                    <span class="block">
                        {{ ceil(str_word_count(strip_tags($post->getContent())) / 200) }} min read
                    </span>
                </span>
            </div>
        </div>
        <hr />
    </a>
</x-wrappers.contained>
