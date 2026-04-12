<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta http-equiv="x-ua-compatible" content="ie=edge" />
        <meta name="description" content="{{ $page->description ?? $page->siteDescription }}" />

        <meta property="og:title" content="{{ $page->title ? $page->title . ' | ' : '' }}{{ $page->siteName }}" />
        <meta property="og:type" content="{{ $page->og_type ?? 'website' }}" />
        <meta property="og:url" content="{{ $page->getUrl() }}" />
        <meta property="og:description" content="{{ $page->description ?? $page->siteDescription }}" />

        <title>{{ $page->siteName ? $page->siteName . ' / ' : '' }}{{ $page->title }}</title>
        <link rel="home" href="{{ $page->baseUrl }}" />
        <link rel="icon" href="/favicon.ico" />
        <link
            href="/blog/feed.atom"
            type="application/atom+xml"
            rel="alternate"
            title="{{ $page->siteName }} Atom Feed"
        />

        @if ($page->production)
            <!-- Insert analytics code here -->
        @endif

        <link href="https://cdn.jsdelivr.net/npm/prismjs/themes/prism.css" rel="stylesheet" />

        <link href="https://fonts.googleapis.com/css2?family=Instrument+Serif:ital@0;1&display=swap" rel="stylesheet" />

        {{--
            <script>
            window.themeConfig = {
            @foreach ($page->themes as $themeKey => $themeData)
            "{{ $themeKey }}": {
            "label": "{{ $themeData['label'] }}",
            "types": {!! json_encode($page->getThemeTypes($themeKey)) !!}
            },
            @endforeach
            };
            </script>
        --}}

        @viteRefresh()
        <link rel="stylesheet" href="{{ vite('source/_assets/css/main.css') }}" />
        <script defer type="module" src="{{ vite('source/_assets/js/main.js') }}"></script>
    </head>

    <body
        x-data="{
            theme: localStorage.getItem('theme') || 'human',
            themeDropdownOpen: false,
            setTheme(value) {
                this.theme = value
                document.documentElement.setAttribute('data-theme', value)
                localStorage.setItem('theme', value)
                this.filterPosts(value)
                this.showHero(value)
            },
            filterPosts(theme) {
                const themeTypes = window.themeConfig?.[theme]?.types || []
                const posts = document.querySelectorAll('.post-item')
                const separators = document.querySelectorAll('.post-separator')

                posts.forEach(function (post) {
                    const postTypes = post.dataset.type
                        ? post.dataset.type.split(' ')
                        : []

                    if (themeTypes.length === 0) {
                        post.style.display = ''
                    } else if (postTypes.some((t) => themeTypes.includes(t))) {
                        post.style.display = ''
                    } else {
                        post.style.display = 'none'
                    }
                })

                // Hide ALL separators first
                separators.forEach(function (sep) {
                    sep.style.display = 'none'
                })

                // Only show separators between visible posts
                const visiblePosts = Array.from(posts).filter(function (p) {
                    return p.style.display !== 'none'
                })

                if (visiblePosts.length > 1) {
                    for (let i = 0; i < visiblePosts.length - 1; i++) {
                        const currentPost = visiblePosts[i]
                        const nextPost = visiblePosts[i + 1]

                        let element = currentPost.nextElementSibling
                        while (element && element !== nextPost) {
                            if (element.classList.contains('post-separator')) {
                                element.style.display = ''
                                break
                            }
                            element = element.nextElementSibling
                        }
                    }
                }
            },
            showHero(theme) {
                document.querySelectorAll('[data-theme-hero]').forEach((hero) => {
                    hero.classList.add('hidden')
                })

                const currentHero = document.querySelector(
                    `[data-theme-hero='${theme}']`,
                )
                if (currentHero) {
                    currentHero.classList.remove('hidden')
                }
            },
        }"
        x-init="
            setTimeout(() => {
                setTheme(theme)
            }, 100)
        "
        :data-theme="theme"
        class="bg-bg text-text flex min-h-screen flex-col justify-between leading-normal"
    >
        <header
            class="fixed top-0 right-0 left-0 z-50 flex h-24 items-center px-4 py-4 transition-colors transition-transform duration-300 lg:relative lg:top-auto lg:right-auto lg:left-auto"
            id="site-header"
            role="banner"
        >
            @include('_components/header')
        </header>

        <main
            role="main"
            class="flex-auto pt-24 lg:pt-0"
            x-init="
                $nextTick(() => {
                    filterPosts(theme)
                    showHero(theme)
                })
            "
        >
            @yield('body')
        </main>

        <footer class="mt-3 bg-gradient-to-b from-transparent to-black/60 py-4 text-center text-sm" role="contentinfo">
            @include('_components/footer')
        </footer>

        <script src="https://cdn.jsdelivr.net/npm/prismjs/prism.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/prismjs/plugins/autoloader/prism-autoloader.min.js"></script>
        @stack('scripts')
    </body>
</html>
