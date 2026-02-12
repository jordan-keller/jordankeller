<?php

use Illuminate\Support\Str;

return [
    'baseUrl' => 'http://jordankeller.test/',
    'production' => false,
    'siteName' => 'Jordan Keller',
    'siteDescription' => 'Jordan Keller is a writer, producer, and musician based in Grand Rapids, Michigan.',
    'siteAuthor' => 'Jordan Keller',
    'pretty_urls' => true,
    'parseMarkdownWithBlade' => true,

    // Theme Configuration
    'defaultTheme' => 'human',
    'themes' => [
        'human' => [
            'label' => 'Human',
            'categories' => [], // Shows ALL posts (empty = no filtering)
            'hero' => [
                'image' => '/assets/img/human-hero.jpg',
                'heading' => 'Living Life Authentically',
                'subheading' => 'Thoughts on being human in a digital world'
            ],
            'about_content' => 'about-default.md',
            'about_image' => '/assets/img/about-default.png',
        ],
        'musician' => [
            'label' => 'Musician',
            'categories' => ['music'], // Only shows music posts
            'hero' => [
                'image' => '/assets/img/musician-hero.jpg',
                'heading' => 'Sound & Fury',
                'subheading' => 'Exploring musical expression'
            ],
            'about_content' => '/about/musician.md',
            'about_image' => '/assets/img/musician.png',
        ],
        'a pharmeteucial jingle writer' => [
            'label' => 'A Pharmaceutical Jingle Writer',
            'categories' => ['advertising', 'health'],
            'hero' => [
                'image' => '/assets/img/pharma-hero.jpg',
                'heading' => 'Jingles That Heal',
                'subheading' => 'Side effects may include catchy tunes'
            ],
            'about_content' => '/about/a-pharmaceutical-jingle-writer.md',
            'about_image' => '/assets/img/a-pharmaceutical-jingle-writer.png',
        ],
        'a true professional' => [
            'label' => 'A True Professional',
            'categories' => ['business', 'professional'],
            'hero' => [
                'image' => '/assets/img/professional-hero.jpg',
                'heading' => 'Business Excellence',
                'subheading' => 'Professional insights and expertise'
            ],
            'about_content' => '/about/a-true-professional.md',
            'about_image' => '/assets/img/a-true-professional.png',
        ],
        'a huge dweeb' => [
            'label' => 'A Huge Dweeb',
            'categories' => ['tech', 'gaming', 'nerd'],
            'hero' => [
                'image' => '/assets/img/dweeb-hero.jpg',
                'heading' => 'Embrace the Dweeb',
                'subheading' => 'Deep dives into tech, gaming, and geek culture'
            ],
            'about_content' => '/about/a-huge-dweeb.md',
            'about_image' => '/assets/img/a-huge-dweeb.png',
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
        return Datetime::createFromFormat('U', $page->date);
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
            if (!$post->categories) {
                return false;
            }
            
            // Check if post has any category that matches theme categories
            return !empty(array_intersect($post->categories, $categories));
        });
    },
];
