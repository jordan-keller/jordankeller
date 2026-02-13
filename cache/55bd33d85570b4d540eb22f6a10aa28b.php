<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="<?php echo e($page->description ?? $page->siteDescription); ?>">

    <meta property="og:title" content="<?php echo e($page->title ? $page->title . ' | ' : ''); ?><?php echo e($page->siteName); ?>"/>
    <meta property="og:type" content="<?php echo e($page->type ?? 'website'); ?>" />
    <meta property="og:url" content="<?php echo e($page->getUrl()); ?>"/>
    <meta property="og:description" content="<?php echo e($page->description ?? $page->siteDescription); ?>" />

    <title><?php echo e($page->title ?  $page->title . ' | ' : ''); ?><?php echo e($page->siteName); ?></title>

    <link rel="home" href="<?php echo e($page->baseUrl); ?>">
    <link rel="icon" href="/favicon.ico">
    <link href="/blog/feed.atom" type="application/atom+xml" rel="alternate" title="<?php echo e($page->siteName); ?> Atom Feed">

    <?php if($page->production): ?>
        <!-- Insert analytics code here -->
    <?php endif; ?>

    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,300i,400,400i,700,700i,800,800i" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/prismjs/themes/prism.css" rel="stylesheet" />

    
<script>
    window.themeConfig = <?php echo json_encode($page->themes); ?>;
</script>

<?php echo vite_refresh(); ?>
    <link rel="stylesheet" href="<?php echo e(vite('source/_assets/css/main.css')); ?>">
    <script defer type="module" src="<?php echo e(vite('source/_assets/js/main.js')); ?>"></script>
</head>

    <body 
x-data="{
    theme: localStorage.getItem('theme') || 'human',
    themeDropdownOpen: false,
    themeDropdown: {
        open: false,
        theme: localStorage.getItem('theme') || 'human'
    },
    $persist: {
        theme: () => localStorage.getItem('theme'),
        'themeDropdown.theme': () => localStorage.getItem('theme')
    },
    setTheme(value) {
        this.theme = value;
        this.themeDropdown.theme = value;
        document.documentElement.setAttribute('data-theme', value);
        localStorage.setItem('theme', value);
        this.filterPosts(value);
        this.showHero(value);
    },
    filterPosts(theme) {
        const themeCategories = window.themeConfig?.[theme]?.categories || [];
        const posts = document.querySelectorAll('.post-item');
        const separators = document.querySelectorAll('.post-separator');
        
        posts.forEach(post => {
            const rawCategories = post.dataset.categories || '';
            // Trim whitespace + normalize case + split
            const postCategories = rawCategories
                .split(',')
                .map(cat => cat.trim().toLowerCase())
                .filter(c => c);
                
            const normalizedThemeCats = themeCategories.map(cat => cat.toLowerCase());
            const hasMatch = postCategories.some(cat => 
                normalizedThemeCats.includes(cat)
            );
            
            if (hasMatch || themeCategories.length === 0) {
                post.style.display = '';
            } else {
                post.style.display = 'none';
            }
        });
        
        // Hide separators when few/no posts visible
        const visiblePosts = Array.from(posts).filter(p => p.style.display !== 'none');
        separators.forEach(sep => {
            sep.style.display = visiblePosts.length > 1 ? '' : 'none';
        });
    },
    showHero(theme) {
        document.querySelectorAll('[data-theme-hero]').forEach(hero => {
            hero.classList.add('hidden');
        });
        
        const currentHero = document.querySelector(`[data-theme-hero='${theme}']`);
        if (currentHero) {
            currentHero.classList.remove('hidden');
        }
    }
}"
x-init="
    setTimeout(() => {
        setTheme(theme);
        filterPosts(theme);
        showHero(theme);
    }, 100);
"
:data-theme="theme"
class="flex flex-col justify-between min-h-screen bg-bg text-text leading-normal font-body"
>

        <header class="flex items-center h-24 py-4" role="banner">
    <div class="container flex items-center max-w-8xl sm:max-w-full mx-auto px-4 lg:px-8 border-b-1 border-[var(--text)]/30">
          
        <span class="flex items-center">
    <a href="/" title="<?php echo e($page->siteName); ?> home" class="inline-flex items-center decoration-transparent">
        <h1 class="text-lg md:text-xl my-0 antialiased tracking-wide"><?php echo e($page->siteName); ?> //</h1>
    </a>
    
    <span class="relative antialiased italic font-normal tracking-wide">
        <button 
            @click="themeDropdownOpen = !themeDropdownOpen"
            class="py-1 rounded text-lg font-light hover:underline ml-0 font-[var(--heading-font)] text-[var(--text)]"
            style="
                font-size: 20px; 
                font-weight: 200;
                min-height: 32px;
                min-width: 80px;
            "
        >
            <span x-text="theme.charAt(0).toUpperCase() + theme.slice(1) || 'Human'"></span>
        </button>
        
        <div 
            x-show="themeDropdownOpen"
            @click.away="themeDropdownOpen = false"
            x-transition
            class="absolute left-0 mt-2 w-64 bg-[var(--bg)]/50 shadow-2xl z-[9999] py-1"
        >
            <button @click="setTheme('human'); themeDropdownOpen = false" 
                    class="block w-full text-left px-4 py-3 hover:bg-gray-800 rounded transition-all font-medium w-full text-left"
                    :class="{ 'bg-green-500 text-black': theme === 'human' }">
                Human
            </button>
            <button @click="setTheme('musician'); themeDropdownOpen = false" 
                    class="block w-full text-left px-4 py-3 hover:bg-gray-800 rounded transition-all font-medium w-full text-left"
                    :class="{ 'bg-green-500 text-black': theme === 'musician' }">
                Musician
            </button>
        </div>
    </span>
</span>

            <span class="flex flex-1 justify-end items-end gap-4 font-sans text-sm">
            <?php echo $__env->make('_nav.menu', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            <?php echo $__env->make('_nav.menu-toggle', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </span>
    </div>
</header>

        <?php echo $__env->make('_nav.menu-responsive', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <main role="main" class="flex-auto w-full container max-w-4xl mx-auto py-8 px-8">
            <?php echo $__env->yieldContent('body'); ?>
        </main>

        <footer class="bg-bg text-center text-sm mt-12 py-4" role="contentinfo">
         <div class="w-80 mx-auto">     
            <?php echo $__env->make('_components.search', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            </div>
            <ul class="flex flex-col md:flex-row justify-center list-none">
                <li class="md:mr-2">
                    &copy; <a href="https://tighten.co" title="Tighten website">Tighten</a> <?php echo e(date('Y')); ?>.
                </li>
                <li>
                    Built with <a href="http://jigsaw.tighten.co" title="Jigsaw by Tighten">Jigsaw</a>
                    and <a href="https://tailwindcss.com" title="Tailwind CSS, a utility-first CSS framework">Tailwind CSS</a>.
                </li>
            </ul>
        </footer>

        <script src="https://cdn.jsdelivr.net/npm/prismjs/prism.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/prismjs/plugins/autoloader/prism-autoloader.min.js"></script>
        <?php echo $__env->yieldPushContent('scripts'); ?>
    </body>
</html>
<?php /**PATH /opt/build/repo/source/_layouts/main.blade.php ENDPATH**/ ?>