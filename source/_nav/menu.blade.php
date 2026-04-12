{{-- Desktop Nav --}}
<nav class="hidden w-full justify-end text-base text-xs tracking-widest uppercase lg:flex">
    @if ($page->nav)
        @foreach ($page->nav as $label => $path)
            
                <a title="{{ $page->siteName }} {{ $label }}"
                href="{{ $path }}"
                class="{{ $page->isActive($path) ? 'active border-b-2 border-current text-[var(--text)] opacity-100' : '' }} ml-6 font-mono text-[var(--link)] no-underline opacity-70 transition-opacity duration-600 hover:underline hover:opacity-100"
            >
                {{ $label }}
            </a>
        @endforeach
    @endif
</nav>

{{-- Mobile Nav --}}
<div onmouseenter="navMenu.open()" onmouseleave="navMenu.close()" class="relative lg:hidden">
    <button
        onclick="navMenu.close()"
        class="flex h-10 w-full items-center justify-end bg-transparent px-5 focus:outline-hidden"
    >
        <svg
            id="js-nav-menu-show"
            xmlns="http://www.w3.org/2000/svg"
            class="text-text h-9 w-7 fill-[var(--link)]"
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
        class="absolute top-full right-0 max-h-0 w-screen overflow-hidden bg-black pr-6 text-right opacity-0 shadow transition-all duration-150 ease-in"
    >
        <ul class="my-0 items-end font-mono text-lg font-bold tracking-widest uppercase">
            @if ($page->nav)
                @foreach ($page->nav as $label => $path)
                    <li class="my-5 pl-4">
                        
                            <a title="{{ $page->siteName }} {{ $label }}"
                            href="{{ $path }}"
                            class="{{ $page->isActive($path) ? 'active text-link' : 'text-link hover:text-hover hover:underline' }} block no-underline"
                        >
                            {{ $label }}
                        </a>
                    </li>
                @endforeach
            @endif
        </ul>
    </nav>
</div>