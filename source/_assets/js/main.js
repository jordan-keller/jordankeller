import Alpine from 'alpinejs';
import Fuse from 'fuse.js';

window.Fuse = Fuse;
window.Alpine = Alpine;

Alpine.start();

import { initContactForm } from './components/contact-form';
import { initNav } from './nav.js';
initNav();

initContactForm();

const header = document.getElementById('site-header');
let lastScrollY = window.scrollY;

window.addEventListener('scroll', () => {
    const currentScrollY = window.scrollY;

    // Transparent/opaque
    if (currentScrollY > 80) {
        header.classList.add('bg-black/100');
        header.classList.remove('bg-transparent');
    } else {
        header.classList.remove('bg-black/100');
        header.classList.add('bg-transparent');
    }

    // Hide/show
    if (currentScrollY > lastScrollY && currentScrollY > 80) {
        // Scrolling down — hide
        header.classList.add('-translate-y-full');
    } else {
        // Scrolling up — show
        header.classList.remove('-translate-y-full');
    }

    lastScrollY = currentScrollY;
});
