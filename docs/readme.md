# Jigsaw Blog Starter Template

This is a starter template for creating a beautiful, customizable blog in Jigsaw with minimal effort. You’ll only have to change a few settings and you’re ready to go.

[View a preview of the blog template.](http://jigsaw-blog-template.tighten.co/)

## Installation

After installing Jigsaw, run the following command from your project directory:

```bash
./vendor/bin/jigsaw init blog
```

This starter template includes samples of common page types, and comes pre-configured with:

- A fully responsive navigation bar
- [Tailwind CSS](https://tailwindcss.com/), a utility CSS framework that allows you to customize your design without touching a line of CSS
- Syntax highlighting using [Prism](https://prismjs.com/)
- A script that automatically generates a `sitemap.xml` file
- A custom 404 page
- A sample contact form
- A search bar powered by [Fuse.js](http://fusejs.io/) and [Alpine.js](https://alpinejs.dev/), which indexes your content automatically and requires zero configuration

---

![Blog starter template screenshot](/.github/screenshots/template-blog.png)

---

### Configuring your new site

As with all Jigsaw sites, configuration settings can be found in `config.php`; you can update the variables in that file with settings specific to your site. You can also add new configuration variables there to use across your site; take a look at the [Jigsaw documentation](http://jigsaw.tighten.co/docs/site-variables/) to learn more.

```php
// config.php
return [
    'baseUrl' => 'https://my-awesome-jigsaw-site.com/',
    'production' => false,
    'siteName' => 'My Site',
    'siteDescription' => 'Give your blog a boost with Jigsaw.',
    ...
];
```

> Tip: This configuration file is also where you’ll define any "collections" (for example, a collection of the contributors to your site, or a collection of blog posts organized by topic). Check out the official [Jigsaw documentation](https://jigsaw.tighten.co/docs/collections/) to learn more.

---

### Adding Content

You can write your content using a [variety of file types](http://jigsaw.tighten.co/docs/content-other-file-types/). By default, this starter template expects your content to be located in the `source/_posts/` folder.

The top of each content page contains a YAML header that specifies how it should be rendered. The `title` attribute is used to dynamically generate HTML `title` and OpenGraph tags for each page. The `extends` attribute defines which parent Blade layout this content file will render with (e.g. `_layouts.post` will render with `source/_layouts/post.blade.php`), and the `section` attribute defines the Blade "section" that expects this content to be placed into it.

```yaml
---
extends: _layouts.post
section: content
title: Getting Started
date: 2022-08-02
description: Getting started with the Jigsaw blog starter template
cover_image: /assets/img/post-cover-image-2.png
featured: true
---
```

---

### Adding Assets

Any assets that need to be compiled, such as JavaScript or CSS using Tailwind, can be added to the `source/_assets/` directory. Vite will process them when running `npm run dev` or `npm run build`, and the processed assets will be stored in `/build_local` or `/build_production`, respectively.

Files that don't require processing (such as images and fonts) can be added directly to `/source/assets/`.

[Read more about compiling assets in Jigsaw using Vite.](http://jigsaw.tighten.co/docs/compiling-assets/)

---

## Building Your Site

Now that you’ve edited your configuration variables and know how to customize your styles and content, let’s build the site.

```bash
# run development server
npm run dev

# build static files with Vite
npm run build
```

# Dynamic Theme + Filterable Blog

using my Jigsaw/Blade/Tailwind static blog (jordankeller/ structure: source/index.blade.php extends main.blade.php, \_posts/ MD with category frontmatter, \_assets/main.css + themes.css). I want:

Client-side theme dropdown in nav (Alpine.js + localStorage, like my prior site.js/layout.blade.php setup): switches CSS vars/classes on <html data-theme='default|terminal|etc'>, persists choice, works post-build_local. Use themes.css for variants (e.g., --bg-primary black/green terminal mode).

On index.blade.php only: JS filter $posts by category frontmatter (e.g., dropdown 'all|tech|music', hide/show via Alpine x-for + :hidden). Keep full $posts in HTML for client-side filtering; no server rebuilds.

Current files:

main.blade.php: [paste full content]

index.blade.php: [paste full content, including @foreach($posts)]

main.css: [paste relevant CSS vars/Tailwind]

themes.css: [paste or describe]

Provide:

Updated main.blade.php (nav dropdown + <html data-theme>)

Updated index.blade.php (category dropdown + x-data for filter)

site.js snippet (Alpine init/theme + filter logic)

themes.css additions (CSS vars per theme)

Build/test steps: npm run dev, check build_local/index.html has all posts hidden/shown correctly.

Handle static: no PHP runtime, pure JS/CSS. Match my Mac/Netlify deploy."

############################################################
############################################################
############################################################
############################################################
############################################################
############################################################
############################################################
############################################################
############################################################

## Shell Alias: `nrd`

Shortcut for `npm run dev`.

1. Open your shell config in the terminal: `nano ~/.zshrc`
2. Add the alias: `alias nrd="npm run dev"`
3. Save and exit: `Ctrl+O` to save, `Ctrl+X` to exit
4. Reload the config: `source ~/.zshrc`

---

# Custom features for a Jigsaw blog, hosted on Netlify, static site, styled with Tailwind CSS, Prettier, Blade

1. Creating the CMS taxonomy for posts using nested associative arrays

- Define `post_type` variables in `config.php` using nested associative arrays:

`'post_types' => [
'music' => ['score', 'song', 'album'],
'writing' => ['essay', 'newsletter', 'blog'],
],

---

## Build a mailchimp with Jigsaw newsleter form (combined comment + mailchimp signup)

Here's the skinny:
i'm thinking about combining my newsletter and my comment form. i have a comment form where people can just emila me and send me emails with comments on posts. i'm interested in combining the two so that peopl ecan sign up for the newsletter but also send comments without sending.i'm trying to think through: what if someone already signed up, but they want to send a comment?what if someone comments but doesnt want to sign up? do i make email optional? what is the actual process for getting someone into the ecosystem here:11:36 PMNavigated form integration complexities and user journey scenariosNavigated form integration complexities and user journey scenariosThe user is thinking through UX/product design for combining a newsletter signup with a comment/email form. Let me think through this with them.DoneThis is a genuinely interesting design problem. Let me think through the scenarios with you.
The four real cases you need to handle:

New person, wants to comment only
New person, wants to subscribe only
New person, wants both
Existing subscriber, wants to comment

The tricky one is #4, and it's actually the one that exposes a fundamental tension: if you combine the forms, you're implying email is required to comment. But if someone's already on your list, re-entering their email to subscribe again will either throw a "you're already subscribed" error from Mailchimp, or silently succeed (and they get a duplicate opt-in email, which is annoying).
A cleaner mental model might be: these are two separate actions that share an email field, not one combined action. The UI could reflect that with a checkbox like "Also sign me up for the newsletter" that appears alongside the comment fields — email required regardless, since you need it to receive their message.
That solves most of it: email is always required (for the comment), the newsletter opt-in is optional and additive, and existing subscribers can uncheck the box and nothing weird happens.
The remaining question is what "sending a comment" actually means on your end. Right now it sounds like it just emails you directly (via a mailto or form service). Is that still how you want it to work, or are you open to comments being stored somewhere — a service like Netlify Forms, Formspree, etc.? That changes the architecture quite a bit, because Mailchimp is only handling the subscribe half; something else has to handle the message half.
What's powering your current comment form?sending a comment = me getting an email. here's the current componenet i've built: <div
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
</script>Show more11:37 PMArchitected dual-submission form merging newsletter signup with comment notificationsArchitected dual-submission form merging newsletter signup with comment notificationsThe user wants to combine their newsletter signup with a comment form. The comment form sends an email to them. Let me think about the architecture:

The form needs to handle two things: Mailchimp subscribe (JSONP) + sending an email to the site owner
For sending emails from a static site on Netlify, Netlify Forms is the easiest solution - it can send email notifications
The checkbox approach: "Also subscribe to newsletter"

The flow:

Email is required (needed for both contact and subscribe)
Message textarea (optional? or required for comment form?)
Checkbox: "Subscribe to newsletter"

On submit:

If checkbox checked → fire Mailchimp JSONP
Always → submit to Netlify Forms (which emails the owner)

So I need to handle both the Mailchimp JSONP call and the Netlify Forms submission in JavaScript, since they're two separate requests happening on the same form submission.
For Netlify Forms, I add the netlify attribute and a hidden form-name field, then preventDefault() and fetch POST the data to the same page URL. If the subscribe checkbox is checked, I also trigger the Mailchimp JSONP call. Then I show a combined status message.
Now I'm thinking through the UX—should the message field be required? If someone just wants to subscribe without leaving a comment, forcing them to fill in a message feels clunky. Maybe I make the message optional and only require either a message or the subscription checkbox to be selected.
Actually, simpler approach: make both the message and checkbox optional, with email always required. That gives users flexibility.
Since this is a Jigsaw static site, Netlify will scan the built HTML at deploy time and pick up the form automatically, so the setup should work smoothly.Show moreDoneGood, that clarifies things. Since you're on Netlify, Netlify Forms is the perfect solution for the "email me" half — you just add a netlify attribute to the form and Netlify captures submissions and emails you. No third-party service needed. Free tier handles it easily.
The architecture then becomes:

On submit, two things happen in parallel:

If the message field has content → POST to Netlify Forms (which emails you)
If the subscribe checkbox is checked → fire the Mailchimp JSONP

Email is always required
Message is optional (subscribe-only is valid)
Subscribe checkbox is optional (comment-only is valid)
At least one must apply (you validate for this)

Here's the combined component:
blade<div
class="my-12 flex items-center justify-center rounded-lg border border-[var(--link)] bg-[var(--text)] p-4 shadow-sm md:p-8 md:px-12 lg:-mx-12"

>

    <form
        id="mc-newsletter-form"
        name="comment"
        action="https://theokaylakes.us17.list-manage.com/subscribe/post-json?u=2da58c5e74e83b874da17678d&id=b7b724795b&f_id=00a642e0f0"
        method="post"
        data-netlify="true"
        class="w-full max-w-3xl"
        novalidate
    >
        {{-- Required by Netlify Forms --}}
        <input type="hidden" name="form-name" value="comment" />

        <div class="flex w-full flex-col items-center gap-4">
            <div class="text-center text-xl font-bold text-gray-900 md:text-2xl">
                Get in touch
            </div>

            {{-- Email --}}
            <div class="w-full max-w-lg">
                <input
                    type="email"
                    required
                    name="EMAIL"
                    id="mc-email"
                    placeholder="Email address"
                    class="w-full rounded-md border-none bg-red-900 px-3 py-3 text-sm text-gray-700 placeholder-gray-400 focus:ring-2 focus:ring-blue-400 focus:outline-none"
                />
            </div>

            {{-- Message --}}
            <div class="w-full max-w-lg">
                <textarea
                    name="message"
                    id="mc-message"
                    rows="4"
                    placeholder="Leave a comment (optional if you're just subscribing)"
                    class="w-full rounded-md border-none bg-red-900 px-3 py-3 text-sm text-gray-700 placeholder-gray-400 focus:ring-2 focus:ring-blue-400 focus:outline-none"
                ></textarea>
            </div>

            {{-- Subscribe checkbox --}}
            <div class="flex w-full max-w-lg items-center gap-2">
                <input
                    type="checkbox"
                    name="subscribe"
                    id="mc-subscribe"
                    class="h-4 w-4 rounded border-gray-300 text-red-400 focus:ring-red-400"
                    checked
                />
                <label for="mc-subscribe" class="text-sm text-gray-900">
                    Subscribe to the newsletter
                </label>
            </div>

            {{-- Mailchimp honeypot — do not remove --}}
            <div aria-hidden="true" style="position: absolute; left: -5000px">
                <input type="text" name="b_2da58c5e74e83b874da17678d_b7b724795b" tabindex="-1" value="" />
            </div>

            {{-- Submit --}}
            <div class="w-full max-w-lg">
                <button
                    type="submit"
                    id="mc-submit"
                    class="w-full rounded-md bg-red-400 px-4 py-3 text-sm font-medium text-white transition-colors duration-150 hover:bg-red-500"
                >
                    Send
                </button>
            </div>

            <div id="mc-status" class="hidden text-center text-sm"></div>
        </div>
    </form>

</div>

<script>
    document.getElementById('mc-newsletter-form').addEventListener('submit', function (e) {
        e.preventDefault();

        const form       = this;
        const email      = document.getElementById('mc-email').value.trim();
        const message    = document.getElementById('mc-message').value.trim();
        const subscribe  = document.getElementById('mc-subscribe').checked;
        const status     = document.getElementById('mc-status');
        const submitBtn  = document.getElementById('mc-submit');

        // Must have an email
        if (!email) {
            showStatus('Please enter your email address.', 'error');
            return;
        }

        // Must be doing at least one thing
        if (!message && !subscribe) {
            showStatus('Please leave a comment or subscribe to the newsletter (or both!).', 'error');
            return;
        }

        submitBtn.disabled = true;
        submitBtn.textContent = 'Sending…';
        status.classList.add('hidden');

        const promises = [];

        // --- Netlify Forms (comment) ---
        if (message) {
            const netlifyData = new FormData();
            netlifyData.append('form-name', 'comment');
            netlifyData.append('EMAIL', email);
            netlifyData.append('message', message);

            promises.push(
                fetch('/', {
                    method: 'POST',
                    body: netlifyData,
                }).then(res => {
                    if (!res.ok) throw new Error('Comment failed');
                    return { type: 'comment', result: 'success' };
                }).catch(() => ({ type: 'comment', result: 'error' }))
            );
        }

        // --- Mailchimp (subscribe) ---
        if (subscribe) {
            promises.push(new Promise((resolve) => {
                const callbackName = 'mcCallback_' + Date.now();
                const url = form.action + '&EMAIL=' + encodeURIComponent(email) + '&c=' + callbackName;

                window[callbackName] = function (data) {
                    delete window[callbackName];
                    document.body.removeChild(script);
                    resolve({ type: 'subscribe', result: data.result, msg: data.msg });
                };

                const script = document.createElement('script');
                script.src = url;
                document.body.appendChild(script);
            }));
        }

        Promise.all(promises).then(results => {
            submitBtn.disabled = false;
            submitBtn.textContent = 'Send';

            const commentResult   = results.find(r => r.type === 'comment');
            const subscribeResult = results.find(r => r.type === 'subscribe');

            const lines = [];

            if (commentResult) {
                if (commentResult.result === 'success') {
                    lines.push('Your comment was sent.');
                } else {
                    lines.push('Comment failed to send — try emailing me directly.');
                }
            }

            if (subscribeResult) {
                if (subscribeResult.result === 'success') {
                    lines.push('Subscribed! Check your inbox to confirm.');
                } else {
                    // Strip HTML Mailchimp sometimes includes in error messages
                    const msg = subscribeResult.msg
                        ? subscribeResult.msg.replace(/<[^>]+>/g, '')
                        : 'Newsletter signup failed.';
                    // "already subscribed" isn't really an error worth alarming people over
                    lines.push(msg.includes('already subscribed') ? 'You\'re already on the list!' : msg);
                }
            }

            const hasError = (commentResult?.result === 'error') ||
                             (subscribeResult?.result === 'error' && !subscribeResult.msg?.includes('already subscribed'));

            showStatus(lines.join(' '), hasError ? 'error' : 'success');

            if (!hasError) form.reset();
        });

        function showStatus(text, type) {
            status.className = 'text-center text-sm ' + (type === 'error' ? 'text-red-500' : 'text-green-600');
            status.textContent = text;
            status.classList.remove('hidden');
        }
    });
</script>

A few things to note:
The checkbox is checked by default — most people landing on this form will be readers who'd want to stay in the loop, so that's the right default. You can flip it if you prefer opt-in-only.
Netlify Forms requires your form to be present in the HTML at build time so Netlify can detect it during deploy. Because of the data-netlify="true" and matching form-name hidden field, that's handled. You'll then need to go to your Netlify dashboard → Forms → Notifications and add your email address to get notified on submissions.
The "already subscribed" case is handled gracefully — it shows a friendly message rather than a red error, since that's not really a problem worth alarming someone over.

1. Build a form to connect to Mailchimp so that users can signup for a mailing list.

2. Have a pop-up window for thanks instead of a full redirect

3. Tag/sort sign-ups into category (setup on Mailchimp's end probably)

Things you haven't asked but need to decide:
Mailchimp integration architecture
The biggest one. You have two real options and they're fundamentally different builds:

Mailchimp's embedded JS form / JSONP — works on a static site with no backend, but is limited and a bit janky with custom styling
Mailchimp API via a serverless function — cleaner UX, full control, but you need a Netlify Function (Node.js lambda) to proxy the API call so your API key isn't exposed in the browser

You're probably going to want the serverless function approach if you care about design control and hiding credentials. Netlify makes this easy but it's a different build than just dropping a form in Blade.
The "category" / tagging mechanism
You said tags are set up on Mailchimp's end, but you need to decide how the form communicates which tag to apply. Options:

Hidden field in the form (tag is hardcoded per page/form instance)
Dropdown or radio buttons the user selects
Inferred from the URL/page the form is on

These are all different implementations. Which is it?
Environment variables / secrets
Where are your MAILCHIMP_API_KEY and MAILCHIMP_LIST_ID living? Netlify's environment variable UI is the right answer, but this needs to be in the plan.
Form UX details you haven't specified:

Just email, or name + email?
Inline form or a button that triggers a modal to open the form?
What does the thank-you popup look like — a toast, a modal overlay, a banner?
What happens on error (already subscribed, invalid email, network failure)?

Jigsaw-specific questions:

Are you using Jigsaw's built-in @yield/@extends layout system and want this as a partial you drop into any page?
Do you have an existing Tailwind config or are we starting fresh?
Are you using Alpine.js already? (It's the natural fit for the popup/modal behavior in a Jigsaw/Blade/Tailwind stack without pulling in a heavy JS framework)

How I'd reformulate the build plan:
Rather than three bullet points, the actual spec should be:

Netlify Function (/netlify/functions/subscribe.js) that accepts POST with email, name, and tag — calls Mailchimp API server-side — returns JSON success/error
Blade partial (\_subscribe-form.blade.php) with Alpine.js handling form state (idle → loading → success → error), submitting via fetch() to the function
Modal/popup component driven by Alpine reactive state, not a redirect
Tag passed as a prop to the partial so any page can include @include('\_partials.subscribe-form', ['tag' => 'newsletter']) and route signups to the right segment

That's a clean, maintainable build. But I need your answers to the above before writing it out.

## Build a component a Jigsaw blog, hosted on Netlify, static site, styled with Tailwind CSS, Prettier, Blade

## A Netlify forms comment component

1. Netlify will collect submissions from a simple HTML form and email me for each new submission.

2. No databases, no API calls, no client-side JS required: just a form with data-netlify="true".

3. Configure netlify's UI to send emails each time someone comments.

4. Add honeypot and/or Captcha to reduce spam

EXTRA: Capture the url of the form from which any given submission is being sent.

{{--
Blog Comment Form — Netlify Forms + Honeypot + reCAPTCHA
─────────────────────────────────────────────────────────
Usage: @include('\_partials.\_blog-comment-form')

    Requirements:
    • Tailwind CSS v3 configured in your Jigsaw project
    • Prettier for formatting (this file is .blade.php, use blade-formatter)
    • Netlify hosting with Forms enabled (free tier: 100 submissions/month)
    • In netlify.toml or via UI: enable spam filtering + email notifications

    Spam protection layers used:
    1. Honeypot field  — catches naive bots that fill every field
    2. Netlify reCAPTCHA — Google reCAPTCHA v2 managed by Netlify (no API key needed)

--}}

{{--
    ─── Hidden form for Netlify's build-time detection ─────────────────────────
    Netlify's CDN crawls your static HTML at deploy time and registers any
    form with data-netlify="true". Because Jigsaw renders Blade to HTML, this
    static copy ensures Netlify finds the form even if the real one is in a loop.
    The action="/thanks" page should be a static Blade template.
--}}

Hidden from real users via CSS (not display:none — some bots skip
those). Netlify silently discards any submission where this field
is filled in.

Netlify hidden input: tells Netlify which registered form this maps to.

        {{--
            ── reCAPTCHA ─────────────────────────────────────────────────────────
            Netlify injects the reCAPTCHA widget automatically at runtime.
            No Google API key required — Netlify manages it for you.
            Netlify docs: https://docs.netlify.com/forms/spam-filters/#recaptcha-2
        --}}


    ─── Tailwind safelist note ──────────────────────────────────────────────────
    All classes above are written inline so Tailwind's JIT scanner picks them up.
    No additional safelist entries needed in tailwind.config.js.

    ─── Honeypot CSS ────────────────────────────────────────────────────────────
    Add this once to your global stylesheet (e.g. app.css) so the honeypot field
    is visually hidden from real users but NOT skipped by bots:

    .hidden-honeypot {
    position: absolute;
    left: -9999px;
    opacity: 0;
    height: 0;
    overflow: hidden;
    pointer-events: none;
    }

    ─── /thanks page ────────────────────────────────────────────────────────────
    Create source/_thanks.blade.php (or .md) so Jigsaw builds a /thanks.html page.
    Netlify will redirect there after a successful form submission.

    @extends('_layouts.main')
    @section('body')
    <div class="mx-auto max-w-xl py-24 text-center">
    <h1 class="text-3xl font-serif font-bold text-stone-800">Thanks!</h1>
    <p class="mt-4 text-stone-500">Your comment is under review and will appear soon.</p>
    <a href="/" class="mt-8 inline-block text-amber-600 underline">← Back to the blog</a>
    </div>
    @endsection

--}}

# Pushing to Netlify

`npm run build` to test full build and diagnose problems
`netlify build` to prep for netlify build
`netlify deploy` to deploy to `develop` branch
