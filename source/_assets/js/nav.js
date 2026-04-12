// _assets/js/nav.js

const header = () => document.getElementById('site-header');
let lastScrollY = window.scrollY;
let menuOpen = false; // ← single source of truth

const navMenu = {
    open() {
        const menu = document.getElementById('js-nav-menu');
        menu.style.maxHeight = menu.scrollHeight + 'px';
        menu.style.opacity = '1';
        document.getElementById('js-nav-menu-hide').classList.remove('hidden');
        document.getElementById('js-nav-menu-show').classList.add('hidden');
    },
    close() {
        const menu = document.getElementById('js-nav-menu');
        menu.style.maxHeight = '0px';
        menu.style.opacity = '0';
        document.getElementById('js-nav-menu-hide').classList.add('hidden');
        document.getElementById('js-nav-menu-show').classList.remove('hidden');
    },
};

export function initNav() {
    window.addEventListener('scroll', () => {
        if (menuOpen) return; // ← don't fight the menu

        const currentScrollY = window.scrollY;

        if (currentScrollY > 80) {
            header().classList.add('bg-black/80');
            header().classList.remove('bg-transparent');
        } else {
            header().classList.remove('bg-black/80');
            header().classList.add('bg-transparent');
        }

        if (currentScrollY > lastScrollY && currentScrollY > 80) {
            header().classList.add('-translate-y-full');
        } else {
            header().classList.remove('-translate-y-full');
        }

        lastScrollY = currentScrollY;
    });

    window.navMenu = {
        open() {
            menuOpen = true;
            const menu = document.getElementById('js-nav-menu');
            menu.style.maxHeight = menu.scrollHeight + 'px';
            menu.style.opacity = '1';
            document.getElementById('js-nav-menu-hide').classList.remove('hidden');
            document.getElementById('js-nav-menu-show').classList.add('hidden');
            header().classList.remove('bg-black/80');
            header().classList.remove('bg-transparent'); // ← add this
            header().classList.add('bg-black');
        },
        close() {
            menuOpen = false;
            const menu = document.getElementById('js-nav-menu');
            menu.style.maxHeight = '0px';
            menu.style.opacity = '0';
            document.getElementById('js-nav-menu-hide').classList.add('hidden');
            document.getElementById('js-nav-menu-show').classList.remove('hidden');
            header().classList.remove('bg-black');
            if (window.scrollY > 80) {
                header().classList.add('bg-black/80');
            } else {
                header().classList.add('bg-transparent'); // ← add this
            }
        },
    };
}
