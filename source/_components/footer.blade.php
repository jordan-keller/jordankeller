<div class="mx-auto w-80">
    @include('_components.search')
</div>

<ul class="md:flex-col opacity-80 text-xs flex list-none flex-col justify-center">
    <li class="md:mr-2">
        &copy;
        <a href="{{ $page->baseUrl }}" title="{{ $page->siteName }}">Jordan Keller</a>
        {{ date('Y') }}.
    </li>
    <li>
        Built with
        <a href="http://jigsaw.tighten.co" title="Jigsaw by Tighten">Jigsaw</a>
        and
        <a href="https://tailwindcss.com" title="Tailwind CSS, a utility-first CSS framework">Tailwind CSS</a>
        .
    </li>
</ul>

@include('_components.comment-follow')
