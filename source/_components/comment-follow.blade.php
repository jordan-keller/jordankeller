{{-- _components/comment-follow.blade.php --}}
<div id="note-drawer" class="fixed bottom-0 left-0 right-0 z-50 flex flex-col items-center">

    {{-- Trigger tab --}}
    <button
        id="note-trigger"
        onclick="toggleNoteDrawer()"
        class="rounded-t-lg bg-[var(--bg)] px-5 py-2 text-xs font-mono text-[var(--text)] shadow-lg transition-colors hover:bg-[var(--link)] hover:text-black focus:outline-none"
        aria-expanded="false"
        aria-controls="note-panel"
    >
        <span id="note-trigger-label">Message Me</span>
    </button>

    {{-- Sliding panel --}}
    <div
        id="note-panel"
        class="w-full overflow-hidden bg-[var(--bg)] shadow-2xl transition-all duration-300 ease-in-out"
        style="max-height: 0;"
        aria-hidden="true"
    >
        <div class="my-8 flex flex-col items-center justify-center p-4 md:p-8 md:px-12">
            <h2 class="text-text mb-4">Send a Message</h2>

            <form
                id="contact-form"
                name="contact"
                data-netlify="true"
                data-netlify-honeypot="bot-field"
                data-mailchimp-url="https://theokaylakes.us17.list-manage.com/subscribe/post-json?u=2da58c5e74e83b874da17678d&id=b7b724795b&f_id=00a642e0f0"
                class="w-full max-w-3xl"
                novalidate
            >
                <input type="hidden" name="form-name" value="contact" />
                <input type="hidden" name="bot-field" />
                <div aria-hidden="true" style="position: absolute; left: -5000px">
                    <input type="text" name="bot-field" tabindex="-1" value="" autocomplete="off" />
                </div>
                <input type="hidden" name="page-url" id="contact-page-url" />

                <div class="flex w-full flex-col items-center gap-4">
                    <div class="w-full max-w-lg">
                        <textarea
                            name="message"
                            id="contact-message"
                            rows="4"
                            placeholder="Write a message (optional — leave blank if you just want email updates)"
                            class="w-full border-none bg-[var(--text)] px-3 py-3 font-mono text-xs text-black placeholder-gray-400 focus:ring-2 focus:ring-[var(--link)] focus:outline-none"
                        ></textarea>
                    </div>

                    <div class="w-full max-w-lg">
                        <input
                            type="email"
                            name="EMAIL"
                            id="contact-email"
                            placeholder="Your email address"
                            required
                            class="w-full border-none bg-[var(--text)] px-3 py-3 font-mono text-xs text-black placeholder-gray-400 focus:ring-2 focus:ring-[var(--link)] focus:outline-none"
                        />
                    </div>

                    <div class="flex w-full max-w-lg items-center gap-2">
                        <input
                            type="checkbox"
                            name="subscribe"
                            id="contact-subscribe"
                            class="h-4 w-4 accent-[var(--link)] focus:ring-yellow-300"
                            checked
                        />
                        <label for="contact-subscribe" class="text-text font-mono text-xs">Sign up for email updates</label>
                    </div>

                    <div class="w-full max-w-lg">
                        <button type="submit" id="contact-submit" class="w-full">Send</button>
                    </div>

                    <p id="contact-status" class="hidden text-center text-sm"></p>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Spacer so page content isn't hidden behind the sticky tab --}}
<div class="h-10"></div>

<script>
function toggleNoteDrawer() {
    const panel = document.getElementById('note-panel');
    const trigger = document.getElementById('note-trigger');
    const label = document.getElementById('note-trigger-label');
    const isOpen = panel.style.maxHeight !== '0px' && panel.style.maxHeight !== '';

    if (isOpen) {
        panel.style.maxHeight = '0';
        panel.setAttribute('aria-hidden', 'true');
        trigger.setAttribute('aria-expanded', 'false');
        label.textContent = 'Message Me';
    } else {
        panel.style.maxHeight = panel.scrollHeight + 'px';
        panel.setAttribute('aria-hidden', 'false');
        trigger.setAttribute('aria-expanded', 'true');
        label.textContent = '✕ close';
    }
}
</script>