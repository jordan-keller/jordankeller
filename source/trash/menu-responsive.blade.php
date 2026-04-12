<nav
    id="js-nav-menu"
    class="max-h-0 w-full overflow-hidden text-right opacity-0 shadow transition-all duration-300 ease-in-out lg:hidden"
>
    <ul class="my-0 items-end font-mono text-base font-bold italic">
        @foreach ([
                'Music' => '/music',
                'Video' => '/video',
                'Writing' => '/writing',
                'All' => '/all',
                'Newsletter' => '/newsletter',
                'About' => '/about',
                'Contact' => '/contact'
            ]
            as $label => $path)
            <li class="pl-4">
                <a
                    title="{{ $page->siteName }} {{ $label }}"
                    href="{{ $path }}"
                    class="{{ $page->isActive($path) ? 'active text-link' : 'text-link hover:text-hover' }} block no-underline"
                >
                    {{ $page->isActive($path) ? $label . '/' : $label }}
                </a>
            </li>
        @endforeach
    </ul>
</nav>
