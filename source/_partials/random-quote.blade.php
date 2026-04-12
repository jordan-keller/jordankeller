<div class="random-quote" id="random-quote">
    <blockquote id="random-quote__text"></blockquote>
    <cite id="random-quote__page"></cite>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const quotes = {!! json_encode($page->quotes['items']) !!};
        const meta = {!! json_encode($page->quotes['meta']) !!};
        const pick = quotes[Math.floor(Math.random() * quotes.length)];

        document.getElementById('random-quote__text').textContent = pick.quote;

        const cite = document.getElementById('random-quote__page');
        cite.textContent = (pick.page ? 'p. ' + pick.page + ' — ' : '') + meta.author + ', ' + meta.title;
    });
</script>
