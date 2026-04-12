@extends('_layouts.main')

@section('body')

<div
    x-data="{
        checked: [],
        toggle(cat) {
            if (this.checked.includes(cat)) {
                this.checked = this.checked.filter((c) => c !== cat)
            } else {
                this.checked.push(cat)
            }
        },
        visible(category, featured) {
            if (this.checked.length === 0) {
                return featured
            }
            return this.checked.includes(category)
        },
    }"
>
    <!-- {{-- Filter Bar --}}
    <div class="sticky top-24 z-40 border-b border-[var(--text)]/10 bg-[var(--bg)] px-4 py-3 lg:top-0">
        <x-wrappers.contained>
            <div
                class="flex flex-wrap items-center gap-x-6 gap-y-2 font-mono text-[0.65rem] tracking-[0.22em] uppercase"
            >
                <span class="text-[var(--text)]/40">Filter</span>

                @foreach (['blog' => 'Blogs', 'newsletter' => 'Newsletters', 'essay' => 'Essays', 'poem' => 'Poems', 'analysis' => 'Analysis'] as $value => $label)
                    <label
                        class="flex cursor-pointer items-center gap-2 text-[var(--text)]/60 transition-colors duration-150 hover:text-[var(--text)]"
                        :class="{ 'text-[var(--text)] opacity-100': checked.includes('{{ $value }}') }"
                    >
                        <input type="checkbox" class="peer sr-only" @change="toggle('{{ $value }}')" />
                        <span
                            class="flex h-3 w-3 shrink-0 items-center justify-center border border-current transition-colors duration-150 peer-checked:bg-[var(--text)]"
                        ></span>
                        {{ $label }}
                    </label>
                @endforeach

                <span
                    x-show="checked.length > 0"
                    x-cloak
                    @click="checked = []"
                    class="ml-auto cursor-pointer text-[var(--text)]/40 transition-colors duration-150 hover:text-[var(--text)]"
                >
                    Clear
                </span>
            </div>
        </x-wrappers.contained>
    </div> -->

    {{-- Posts --}}
    <x-wrappers.contained>
        @foreach ($posts->where('type', 'writing') as $post)
            <div
                x-show="visible('{{ $post->category }}', {{ $post->featured ? 'true' : 'false' }})"
                x-cloak
                class="post-item w-full"
                data-category="{{ $post->category }}"
                data-featured="{{ $post->featured ? 'true' : 'false' }}"
            >
                <a
                    href="{{ '/' . ltrim($post->getPath(), '/') }}"
                    title="Read - {!! $post->title !!}"
                    class="text-[var(--text)] no-underline opacity-90 transition duration-200 hover:opacity-100"
                >
                    <div class="mx-auto my-0 flex flex-col py-0">
                        <div class="flex justify-between gap-4">
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
                                    <p
                                        class="my-0 font-mono text-[0.65rem] tracking-[0.22em] text-[var(--text)]/60 uppercase"
                                    >
                                        {{ $page->getTypeLabel($post->category) }}
                                    </p>
                                @endif

                                <h3 class="mt-0 mb-0 font-mono text-base font-bold tracking-wide text-[var(--text)]">
                                    {!! $post->title !!}
                                </h3>
                                <p class="mt-1 mb-0 font-mono text-sm leading-relaxed text-[var(--text)]/60">
                                    {!! $post->description !!}
                                </p>
                            </div>

                            <div class="flex shrink-0 flex-col items-end justify-center font-mono text-[0.65rem] tracking-[0.22em] text-[var(--text)]/60 uppercase">
    <span class="block">{{ $post->getDate()->format('Y-m-d') }}</span>
    <span class="block">
        {{ ceil(str_word_count(strip_tags($post->getContent())) / 200) }} min read
    </span>
</div>
                    </div>
                    <hr />
                </a>
            </div>
        @endforeach
    </x-wrappers.contained>
</div>

@stop
