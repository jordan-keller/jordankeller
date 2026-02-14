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

    'vite' => [
        'build_path' => 'assets/build',
    ],
    
    'defaultTheme' => 'human',
    'themes' => [
        'human' => [
            'label' => 'Human',
            'categories' => [], // Shows ALL posts (empty = no filtering)
            'hero' => [
                'image' => '/assets/img/human-hero.jpg',
                'heading' => 'All Posts',
                'subheading' => 'The everything feed'
            ], // ← Added missing comma here!
            'about_content' => 'about-default.md',
            'about_image' => '/assets/img/about-default.png',
        ],
        'musician' => [
            'label' => 'Musician',
            'categories' => ['music'],
            'hero' => [
                'image' => '/assets/img/musician-hero.jpg',
                'heading' => 'Music',
                'subheading' => 'Songwriting, production, and musical musings.'
            ],
            'about_content' => '/about/musician.md',
            'about_image' => '/assets/img/musician.png',
        ],

    ],
    
    // Collections
    'collections' => [
        'posts' => [
            'author' => 'Jordan Keller',
            'sort' => '-date',
            'path' => 'blog/{filename}',
        ],
        'categories' => [
            'path' => '/blog/categories/{filename}',
            'posts' => function ($page, $allPosts) {
                return $allPosts->filter(function ($post) use ($page) {
                    return $post->categories ? in_array($page->getFilename(), $post->categories, true) : false;
                });
            },
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

    // Helper to get posts filtered by theme
    'getPostsByTheme' => function ($posts, $theme, $allThemes) {
        if (!isset($allThemes[$theme])) {
            $theme = 'human'; // fallback to default
        }
        
        $categories = $allThemes[$theme]['categories'] ?? [];
        
        return $posts->filter(function ($post) use ($categories) {
            if (!$post->categories || !is_array($post->categories)) {
                return empty($categories); // Show uncategorized posts on "human" theme
            }
            
            $postCats = array_map('trim', $post->categories);
            $themeCats = array_map('trim', $categories);
            
            return empty($categories) || !empty(array_intersect($postCats, $themeCats));
        });
    },
];