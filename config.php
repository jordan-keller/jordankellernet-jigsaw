<?php

use Illuminate\Support\Str;

return [
    'baseUrl' => 'https://jordankellernet-jigsaw.test/',
    'production' => false,
    'siteName' => 'Jordan Keller',
    'siteDescription' => 'Hey Jordan, remember to edit the config.php to give the site a sexy description. Sincereley, Jordan',
    'siteAuthor' => 'Jordan Keller',
    'pretty_urls' => true,

    // collections
    'collections' => [
        'posts' => [
            'author' => 'Jordan Keller', // Default author, if not provided in a post
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

    // helpers
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

    'themes' => [
        'default' => [
            'about_content' => 'about-default.md',
            'about_image' => '/assets/img/about-default.png',
        ],
        'a true professional' => [
            'about_content' => '/about/a-true-professional.md',
            'about_image' => '/assets/img/a-true-professionalk.png',
        ],
        'a pharmaceutical jingle writer' => [
            'about_content' => '/about/a-pharmaceutical-jingle-writer.md',
            'about_image' => '/assets/img/a-pharmaceutical-jingle-writer.png',
        ],
        'a huge dweeb' => [
            'about_content' => '/about/a-huge-dweeb.md',
            'about_image' => '/assets/img/a-huge-dweeb.png',
        ],
    ],
];
