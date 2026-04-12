<div onmouseenter="navMenu.open()" onmouseleave="navMenu.close()" class="lg:hidden">
    <button class="flex h-10 items-center justify-end bg-transparent focus:outline-hidden">
        <svg
            id="js-nav-menu-show"
            xmlns="http://www.w3.org/2000/svg"
            class="text-text h-9 w-7 fill-current"
            viewBox="0 0 32 32"
        >
            <path
                d="M4,10h24c1.104,0,2-0.896,2-2s-0.896-2-2-2H4C2.896,6,2,6.896,2,8S2.896,10,4,10z M28,14H4c-1.104,0-2,0.896-2,2  s0.896,2,2,2h24c1.104,0,2-0.896,2-2S29.104,14,28,14z M28,22H4c-1.104,0-2,0.896-2,2s0.896,2,2,2h24c1.104,0,2-0.896,2-2  S29.104,22,28,22z"
            />
        </svg>

        <svg
            id="js-nav-menu-hide"
            xmlns="http://www.w3.org/2000/svg"
            class="text-hover hidden h-9 w-7 fill-current"
            viewBox="0 0 36 30"
        >
            <polygon
                points="32.8,4.4 28.6,0.2 18,10.8 7.4,0.2 3.2,4.4 13.8,15 3.2,25.6 7.4,29.8 18,19.2 28.6,29.8 32.8,25.6 22.2,15 "
            />
        </svg>
    </button>

    <nav
        id="js-nav-menu"
        class="max-h-0 w-full translate-y-10 overflow-hidden bg-black text-right opacity-0 shadow transition-all duration-300 ease-in-out"
    >
        <ul class="my-3 items-end font-mono font-bold">
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
</div>
