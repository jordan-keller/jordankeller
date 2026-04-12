<div
    class="my-12 flex items-center justify-center rounded-lg border border-[var(--link)] bg-[var(--text)] p-4 shadow-sm md:p-8 md:px-12 lg:-mx-12"
>
    <form
        id="mc-newsletter-form"
        action="https://theokaylakes.us17.list-manage.com/subscribe/post-json?u=2da58c5e74e83b874da17678d&id=b7b724795b&f_id=00a642e0f0"
        method="post"
        class="w-full max-w-3xl"
        novalidate
    >
        <div class="flex w-full flex-col items-center gap-3 md:gap-4">
            <div class="text-center text-xl font-bold text-gray-900 md:text-2xl">Sign up for our newsletter</div>
            <div class="flex w-full max-w-lg">
                <input
                    type="email"
                    required
                    name="EMAIL"
                    id="mc-email"
                    placeholder="Email address"
                    class="flex-1 rounded-l-md border-none bg-red-900 px-3 py-3 text-sm text-gray-700 placeholder-gray-400 focus:ring-2 focus:ring-blue-400 focus:outline-none"
                />
                <button
                    type="submit"
                    id="mc-submit"
                    class="rounded-r-md bg-red-400 px-4 py-3 text-sm font-medium text-white transition-colors duration-150 hover:bg-red-500 md:px-8"
                >
                    Subscribe
                </button>
            </div>

            {{-- Mailchimp honeypot — do not remove, prevents bot signups --}}
            <div aria-hidden="true" style="position: absolute; left: -5000px">
                <input type="text" name="b_2da58c5e74e83b874da17678d_b7b724795b" tabindex="-1" value="" />
            </div>
            <div id="mc-status" class="hidden text-center text-sm"></div>
        </div>
    </form>
</div>

<script>
    document.getElementById('mc-newsletter-form').addEventListener('submit', function (e) {
        e.preventDefault();

        const form = this;
        const email = document.getElementById('mc-email').value;
        const status = document.getElementById('mc-status');
        const submitBtn = document.getElementById('mc-submit');

        if (!email) return;

        submitBtn.disabled = true;
        submitBtn.textContent = 'Subscribing…';
        status.className = 'text-sm text-center';
        status.textContent = '';

        // Mailchimp requires JSONP for cross-origin requests from static sites
        const callbackName = 'mcCallback_' + Date.now();
        const baseUrl = form.action.replace('/post-json', '/post-json');
        const url = baseUrl + '&EMAIL=' + encodeURIComponent(email) + '&c=' + callbackName;

        window[callbackName] = function (data) {
            delete window[callbackName];
            document.body.removeChild(script);
            submitBtn.disabled = false;
            submitBtn.textContent = 'Subscribe';
            status.classList.remove('hidden');

            if (data.result === 'success') {
                status.classList.add('text-green-600');
                status.textContent = 'Thanks for subscribing! Check your inbox to confirm.';
                form.reset();
            } else {
                status.classList.add('text-red-600');
                // Mailchimp returns HTML in the msg field — strip tags for display
                const msg = data.msg ? data.msg.replace(/<[^>]+>/g, '') : 'Something went wrong. Please try again.';
                status.textContent = msg;
            }
        };

        const script = document.createElement('script');
        script.src = url;
        document.body.appendChild(script);
    });
</script>
