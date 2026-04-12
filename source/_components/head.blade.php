<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="description" content="{{ $page->description ?? $page->siteDescription }}" />

    <meta property="og:title" content="{{ $page->title ? $page->title . ' | ' : '' }}{{ $page->siteName }}" />
    <meta property="og:type" content="{{ $page->type ?? 'website' }}" />
    <meta property="og:url" content="{{ $page->getUrl() }}" />
    <meta property="og:description" content="{{ $page->description ?? $page->siteDescription }}" />

    <title>{{ $page->title ? $page->title . ' | ' : '' }}{{ $page->siteName }}</title>

    <link rel="home" href="{{ $page->baseUrl }}" />
    <link rel="icon" href="/favicon.ico" />
    <link href="/blog/feed.atom" type="application/atom+xml" rel="alternate" title="{{ $page->siteName }} Atom Feed" />

    <link
        href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,300i,400,400i,700,700i,800,800i"
        rel="stylesheet"
    />
    <link href="https://cdn.jsdelivr.net/npm/prismjs/themes/prism.css" rel="stylesheet" />

    @viteRefresh()
    <link rel="stylesheet" href="{{ vite('source/_assets/css/main.css') }}" />
    <script defer type="module" src="{{ vite('source/_assets/js/main.js') }}"></script>
</head>
