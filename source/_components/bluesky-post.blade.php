{{--
    Bluesky Post Embed Component
    Usage: <x-bluesky-post url="https://bsky.app/profile/handle.bsky.social/post/rkey" />
--}}

@props([
    'url',
])

@php
    preg_match('~bsky\.app/profile/([^/]+)/post/([^/?&#]+)~', $url, $m);
    $atUri = isset($m[1], $m[2]) ? "at://{$m[1]}/app.bsky.feed.post/{$m[2]}" : null;
@endphp

@if ($atUri)
    <blockquote class="bluesky-embed" data-bluesky-uri="{{ $atUri }}">
        <a href="{{ $url }}">View post on Bluesky</a>
    </blockquote>

    @once('bluesky-embed-script')
        <script async src="https://embed.bsky.app/static/embed.js" charset="utf-8"></script>
    @endonce
@endif
