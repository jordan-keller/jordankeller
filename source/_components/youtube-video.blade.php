@props([
    'id',
    'title' => 'Video',
])

<div class="youtube-embed mx-auto my-10 shadow-[0_0_10px_var(--link)]" role="region" aria-label="{{ $title }}">
    <iframe
        src="https://www.youtube-nocookie.com/embed/{{ $id }}?rel=0&modestbranding=1&playsinline=1"
        title="{{ $title }}"
        class="youtube-iframe"
        frameborder="0"
        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
        allowfullscreen
        loading="lazy"
    ></iframe>
</div>
