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
            'types' => [], // Empty array = show all types
            'hero' => [
                'image' => '/assets/img/human-hero.jpg',
                'heading' => 'All Posts',
                'subheading' => 'The everything feed'
            ],
            'about_content' => 'about-default.md',
            'about_image' => '/assets/img/about-default.png',
        ],
        'musician' => [
            'label' => 'Musician',
            'types' => ['music'], // Multiple types
            'hero' => [
                'image' => '/assets/img/musician-hero.jpg',
                'heading' => 'Music',
                'subheading' => 'Songwriting, production, and musical musings.'
            ],
            'about_content' => '/about/musician.md',
            'about_image' => '/assets/img/musician.png',
        ],
        'writer' => [
            'label' => 'Writer',
            'types' => ['analysis', 'screenplay', 'essay'], // Multiple types
            'hero' => [
                'image' => '/assets/img/writer-hero.jpg',
                'heading' => 'Writing',
                'subheading' => 'Essays, screenplays, and analysis.'
            ],
            'about_content' => '/about/writer.md',
            'about_image' => '/assets/img/writer.png',
        ],
    ],
    
    'collections' => [
        'posts' => [
            'author' => 'Jordan Keller',
            'sort' => '-date',
            'path' => 'blog/{filename}',
        ],
        'categories' => [
            'path' => '/blog/categories/{filename}',
            'posts' => function ($page, $allPosts) {
                // Get the category name from the page filename
                $categorySlug = $page->getFilename();
                
                return $allPosts->filter(function ($post) use ($categorySlug) {
                    // Check if post has categories and it's an array
                    if (!isset($post->categories) || !is_array($post->categories)) {
                        return false;
                    }
                    
                    // Check if any of the post's categories match this category slug
                    return in_array($categorySlug, $post->categories, true);
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

    // Helper to get posts filtered by category
    'getPostsByCategory' => function ($posts, $category) {
        return $posts->filter(function ($post) use ($category) {
            return isset($post->categories) && is_array($post->categories) && in_array($category, $post->categories);
        });
    },
];