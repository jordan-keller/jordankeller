export function initContactForm() {
    const form = document.getElementById('contact-form');

    if (!form) return;

    const emailEl = document.getElementById('contact-email');
    const messageEl = document.getElementById('contact-message');
    const subscribeEl = document.getElementById('contact-subscribe');
    const statusEl = document.getElementById('contact-status');
    const submitBtn = document.getElementById('contact-submit');

    form.addEventListener('submit', async (e) => {
        e.preventDefault();

        const email = emailEl.value.trim();
        const message = messageEl.value.trim();
        const subscribe = subscribeEl.checked;

        if (!email) {
            return showStatus('Please enter your email address.', 'error');
        }

        if (!message && !subscribe) {
            return showStatus('Please leave a message or subscribe to the newsletter (or both).', 'error');
        }

        setLoading(true);

        document.getElementById('contact-page-url').value = window.location.href;

        const results = await Promise.all(
            [
                message ? submitToNetlify(email, message) : null,
                subscribe ? submitToMailchimp(email, message) : null,
            ].filter(Boolean),
        );

        setLoading(false);

        const commentResult = results.find((r) => r.type === 'comment');
        const subscribeResult = results.find((r) => r.type === 'subscribe');
        const lines = [];

        if (commentResult) {
            lines.push(commentResult.ok ? 'Your message was sent.' : 'Message failed â€” try emailing me directly.');
        }

        if (subscribeResult) {
            if (subscribeResult.ok) {
                lines.push('Subscribed! Check your inbox to confirm.');
            } else {
                const msg = (subscribeResult.msg ?? 'Newsletter signup failed.').replace(/<[^>]+>/g, '');
                lines.push(msg.toLowerCase().includes('already subscribed') ? "You're already on the list!" : msg);
            }
        }

        const hasError = results.some((r) => !r.ok);
        showStatus(lines.join(' '), hasError ? 'error' : 'success');

        if (!hasError) form.reset();
    });

    async function submitToNetlify(email, message) {
        const body = new URLSearchParams();
        body.append('form-name', 'contact');
        body.append('bot-field', ''); // ← add this
        body.append('EMAIL', email);
        body.append('message', message);
        body.append('page-url', window.location.href);

        try {
            const res = await fetch('/', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: body.toString(),
            });
            return { type: 'comment', ok: res.ok };
        } catch {
            return { type: 'comment', ok: false };
        }
    }

    function submitToMailchimp(email, message) {
        return new Promise((resolve) => {
            const callbackName = 'mcCallback_' + Date.now();
            const url =
                form.dataset.mailchimpUrl +
                '&EMAIL=' +
                encodeURIComponent(email) +
                '&MESSAGE=' +
                encodeURIComponent(message) +
                '&PAGEURL=' +
                encodeURIComponent(window.location.href) +
                '&c=' +
                callbackName;

            let settled = false;

            const finish = (data) => {
                if (settled) return;
                settled = true;
                clearTimeout(timer);
                delete window[callbackName];
                script.remove();
                resolve({ type: 'subscribe', ok: data.result === 'success', msg: data.msg });
            };

            const timer = setTimeout(() => finish({ result: 'error', msg: 'Request timed out.' }), 8000);

            window[callbackName] = finish;

            const script = document.createElement('script');
            script.src = url;
            document.body.appendChild(script);
        });
    }

    function setLoading(loading) {
        submitBtn.disabled = loading;
        submitBtn.textContent = loading ? 'Sendingâ€¦' : 'Send';
        statusEl.classList.add('hidden');
    }

    function showStatus(text, type) {
        statusEl.className = 'text-center text-sm ' + (type === 'error' ? 'text-red-500' : 'text-[var(--link)]');
        statusEl.textContent = text;
        statusEl.classList.remove('hidden');
    }
}
