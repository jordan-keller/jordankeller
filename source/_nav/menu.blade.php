<nav class="hidden lg:flex items-end justify-end text-md uppercase tracking-widest text-xs">
    <a title="{{ $page->siteName }} Blog" href="/blog"
        class="opacity-70 hover:opacity-100 transition transition-opacity duration-600 ml-6 {{ $page->isActive('/blog') ? 'active border-b-2 border-current opacity-100' : '' }}">
        Blog
    </a>

    <a title="{{ $page->siteName }} About" href="/about"
        class="opacity-70 hover:opacity-100 transition transition-opacity duration-600 ml-6 {{ $page->isActive('/about') ? 'active border-b-2 border-current opacity-100' : '' }}">
        About
    </a>

    <a title="{{ $page->siteName }} Contact" href="/contact"
        class="opacity-70 hover:opacity-100 transition transition-opacity duration-600 ml-6 {{ $page->isActive('/contact') ? 'active border-b-2 border-current opacity-100' : '' }}">
        Contact
    </a>
</nav>