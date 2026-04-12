<span class="flex flex-1">
    <a href="/" title="{{ $page->siteName }} home" class="flex flex-1 items-center text-nowrap decoration-transparent">
        <h3 class="vhs-glow my-0 tracking-wide antialiased">{{ $page->siteName }}</h3>
    </a>
</span>

<span class="flex w-full flex-1 items-center justify-end">
    @include('_nav.menu')
</span>
