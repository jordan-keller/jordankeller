<?php

use Illuminate\Support\Str;

return [
'baseUrl' => 'http://jordankeller.test/',
'production' => false,
    'siteName' => 'Jordan Keller',
    'siteDescription' => 'Writer, producer, and musician in Grand Rapids, Michigan.',
    'siteAuthor' => 'Jordan Keller',
    'pretty_urls' => true,
    'parseMarkdownWithBlade' => true,

'nav' => [
    'Read'   => '/read',
    'Listen' => '/listen',
    'Watch'  => '/watch',
    'Tags '   => '/tags',
    'Follow' => '/follow',
],

    'vite' => [
        'build_path' => 'assets/build',
    ],
    
    'defaultTheme' => 'human',
    'themes' => [
        'human' => [
            'label' => 'Human',
            'types' => [],
            'hero' => [
                'image' => '/assets/img/human-hero.jpg',
                'heading' => 'Featured',
            ],
            'about_content' => 'about-default.md',
            'about_image' => '/assets/img/about-default.png',
        ],
        'musician' => [
            'label' => 'Musician',
            'types' => ['music'],
            'hero' => [
                'heading' => 'Music Posts',
            ],
            'about_content' => '/about/musician.md',
            'about_image' => '/assets/img/musician.png',
        ],
        'writer' => [
            'label' => 'Writer',
            'types' => ['writing'],
            'hero' => [
                'image' => '/assets/img/writer-hero.jpg',
                'heading' => 'Writings',
                'subheading' => 'Essays, screenplays, and analysis.'
            ],
            'about_content' => '/about/writer.md',
            'about_image' => '/assets/img/writer.png',
        ],
    ],

    'post_types' => [
        'music' => [
            'album',
            'song',
            'score',
            'liner-note',
            'live-performance',
        ],
        'video' => [
            'music-video',
            'album-trailer',
            'live-performance',
        ],
        'writing' => [
            'essay',
            'analysis',
            'blog',
            'liner-notes',
        ],
        'podcast' => [],
        'newsletter' => [
            'newsletter',
        ],
    ],

    'getTypeLabel' => function ($page, $type) {
        $labels = [
            'live-performance' => 'Live Performance',
            'music-video'      => 'Music Video',
            'album-trailer'    => 'Album Trailer',
        ];
        return $labels[$type] ?? ucwords(str_replace('-', ' ', $type));
    },
    
    'collections' => [
        'posts' => [
            'author' => 'Jordan Keller',
            'sort' => '-date',
            'path' => '{type}/{filename}',
            'word_count' => function ($page) {
                return str_word_count(strip_tags($page->getContent()));
            },
        ],
        'newsletter' => [
            'path' => 'newsletter/{filename}',
            'extends' => '_layouts.newsletter',
            'section' => 'content',
            'sort' => '-date',
        ],
        'types' => [
            'path' => function($page) {
                return "{$page->type}";
            },
            'extends' => '_layouts.type',
        ],
        'tags' => [
    'path' => 'tags/{tag}',
    'extends' => '_layouts.tag',
    'section' => 'body',
],
    ],

    // Helper Functions
    'getDate' => function ($page) {
        return \DateTime::createFromFormat('U', $page->date);
    },
    
    'getExcerpt' => function ($page, $length = 255) {
        if ($page->excerpt) {
            return $page->excerpt;
        }

        $content = preg_split('/<!-- more -->/m', $page->getContent(), 2);
        $cleaned = trim(
            strip_tags(
                preg_replace(['/<pre>[\w\W]*?<\/pre>/', '/<h\d>[\w\W]*?<\/h\d>/'], '', $content[0]),
                '<code>'
            )
        );

        if (count($content) > 1) {
            return $cleaned;
        }

        $truncated = substr($cleaned, 0, $length);

        if (substr_count($truncated, '<code>') > substr_count($truncated, '</code>')) {
            $truncated .= '</code>';
        }

        return strlen($cleaned) > $length
            ? preg_replace('/\s+?(\S+)?$/', '', $truncated) . '...'
            : $cleaned;
    },
    
    'isActive' => function ($page, $path) {
        return Str::endsWith(trimPath($page->getPath()), trimPath($path));
    },

    'allPostTypes' => function ($page) {
        $postTypes = is_array($page->post_types) ? $page->post_types : $page->post_types->toArray();
        return array_merge(...array_values($postTypes));
    },

    'getPostBySlug' => function($page, $slug) {
        return $page->getCollection('posts')->firstWhere('slug', $slug);
    },
    
    'getFeaturedPost' => function($page) {
        return $page->getCollection('posts')->firstWhere('featured', true);
    },

    'getThemeTypes' => function ($page, $themeKey) {
        $theme = $page->themes[$themeKey];
        $themeTypes = is_array($theme) ? $theme : $theme->toArray();
        
        if (empty($themeTypes['types'])) return [];
        
        $postTypes = is_array($page->post_types) ? $page->post_types : $page->post_types->toArray();
        
        return array_merge(...array_map(
            fn($cat) => $postTypes[$cat] ?? [],
            (array) $themeTypes['types']
        ));
    },

    'filteredPosts' => function ($page, $posts) {
    return $posts->filter(function ($post) use ($page) {
        if ($post instanceof Closure) return false;
        if (!is_object($post)) return false;
        
        $tags = $post->tags;
        if (!$tags) return false;

        $tagList = is_array($tags) ? $tags : (is_string($tags) ? preg_split('/\s*,\s*/', $tags) : $tags->toArray());

        return in_array($page->tag, array_map('trim', $tagList));
    });
},
    'quotes' => require __DIR__ . '/source/_data/quotes.php',

    'newsletterPosts' => function($config) {
        return $config->posts->filter(fn($post) => $post->newsletter === true)
                             ->sortByDesc('date');
    },

];