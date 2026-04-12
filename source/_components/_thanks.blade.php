<section class="mx-auto mt-16 max-w-2xl border-t border-stone-200 pt-12" aria-labelledby="comment-form-heading">
    I appreciate your outreatch. I don't know how to thank you, so here's a random post in the hopes it might be of
    interest to you:

    {{--
        Random Post Widget — _partials/_random-post.blade.php
        ───────────────────────────────────────────────────────
        Displays one randomly selected post from your $posts collection.
        No JS, no API calls — Jigsaw resolves $posts at build time.
        
        Usage: @include('_partials._random-post')
        
        Requirements:
        • Posts must live in source/_posts/ and be collected in config.php:
        'collections' => [
        'posts' => [
        'path' => 'posts/{filename}',
        'sort' => '-date',
        ],
        ],
        • Each post should have `title` and `date` in its front matter.
        An optional `description` front matter field is used if present.
    --}}

    @php
        // $posts is the Jigsaw collection — an Illuminate Collection instance.
        // ->random() picks one item using array_rand() under the hood.
        // Guard with a count check so the widget degrades gracefully on
        // a brand-new blog that has no posts yet.
        $randomPost = $posts->count() ? $posts->random() : null;
    @endphp

    @if ($randomPost)
        <aside
            class="mx-auto mt-10 max-w-sm rounded-2xl border border-stone-200 bg-stone-50 px-6 py-5 shadow-sm"
            aria-label="Suggested reading"
        >
            <p class="mb-3 text-xs font-semibold tracking-widest text-stone-400 uppercase">While you're here</p>

            <a href="{{ $randomPost->getUrl() }}" class="group block">
                <h3
                    class="font-serif text-lg leading-snug font-semibold text-stone-800 transition duration-150 group-hover:text-amber-600"
                >
                    {{ $randomPost->title }}
                </h3>

                @if ($randomPost->description)
                    <p class="mt-1.5 text-sm leading-relaxed text-stone-500">
                        {{ $randomPost->description }}
                    </p>
                @endif

                <span
                    class="mt-3 inline-flex items-center gap-1 text-sm font-medium text-amber-600 transition duration-150 group-hover:gap-2"
                >
                    Read post
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-3.5 w-3.5 transition-transform duration-150 group-hover:translate-x-0.5"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2.5"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        aria-hidden="true"
                    >
                        <path d="M5 12h14M12 5l7 7-7 7" />
                    </svg>
                </span>
            </a>
        </aside>
    @endif
</section>
