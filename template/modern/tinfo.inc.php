<?php
/**
 * Modern OPAC Template Configuration
 * Based on Material Design 3 color system
 */

$sysconf['template']['base'] = 'php';
$sysconf['template']['responsive'] = true;

$sysconf['template']['classic_library_subname'] = 0;
$sysconf['template']['classic_slide_transition'] = 'blur';
$sysconf['template']['classic_slide_animation'] = 'none';
$sysconf['template']['classic_slide_delay'] = 5000;
$sysconf['template']['classic_popular_collection'] = 1;
$sysconf['template']['classic_popular_collection_item'] = 8;
$sysconf['template']['classic_new_collection'] = 1;
$sysconf['template']['classic_new_collection_item'] = 6;
$sysconf['template']['classic_top_reader'] = 1;
$sysconf['template']['classic_suggestion'] = 1;
$sysconf['template']['classic_map'] = 0;
$sysconf['template']['classic_map_link'] = '';
$sysconf['template']['classic_map_desc'] = '';
$sysconf['template']['classic_fb_link'] = 'https://www.facebook.com/groups/senayan.slims';
$sysconf['template']['classic_twitter_link'] = 'https://twitter.com/slims_official';
$sysconf['template']['classic_youtube_link'] = 'https://youtube.com';
$sysconf['template']['classic_instagram_link'] = 'https://instagram.com/slims.sdc';
$sysconf['template']['visitor_log_voice'] = 1;
$sysconf['template']['classic_footer_about_us'] = <<<HTML
<p>Layanan perpustakaan terpadu Madrasah Aliyah Negeri 2 Lombok Timur. Berkomitmen menyediakan akses pengetahuan bagi civitas akademika.</p>
HTML;
$sysconf['template']['classic_library_disableslide'] = 1;


$sysconf['template']['option'][$sysconf['template']['theme']] = [
    'responsive' => [
        'dbfield' => 'responsive',
        'label' => __('Enable this theme for mobile?'),
        'type' => 'dropdown',
        'default' => 1,
        'data' => [
            [1, __('Yes, please!')],
            [0, __('No, I want use lightweight theme')]
        ]
    ],
    'subtitle' => [
        'dbfield' => 'classic_library_subname',
        'label' => __('Library Sub Name'),
        'type' => 'dropdown',
        'default' => 0,
        'data' => [
            [1, __('Show')],
            [0, __('Hide')]
        ]
    ],
    'popular-collection' => [
        'dbfield' => 'classic_popular_collection',
        'label' => __('Popular Collection'),
        'type' => 'dropdown',
        'default' => 1,
        'data' => [
            [1, __('Show')],
            [0, __('Hide')]
        ]
    ],
    'popular-collection-item' => [
        'dbfield' => 'classic_popular_collection_item',
        'label' => __('Popular Items'),
        'type' => 'text',
        'default' => 8
    ],
    'new-collection' => [
        'dbfield' => 'classic_new_collection',
        'label' => __('New Collection'),
        'type' => 'dropdown',
        'default' => 1,
        'data' => [
            [1, __('Show')],
            [0, __('Hide')]
        ]
    ],
    'new-collection-item' => [
        'dbfield' => 'classic_new_collection_item',
        'label' => __('New Items'),
        'type' => 'text',
        'default' => 6
    ],
    'top-reader' => [
        'dbfield' => 'classic_top_reader',
        'label' => __('Top Reader'),
        'type' => 'dropdown',
        'default' => 1,
        'data' => [
            [1, __('Show')],
            [0, __('Hide')]
        ]
    ],
    'suggestion' => [
        'dbfield' => 'classic_suggestion',
        'label' => __('Suggestion'),
        'type' => 'dropdown',
        'default' => 1,
        'data' => [
            [1, __('Show')],
            [0, __('Hide')]
        ]
    ],
    'fb-link' => [
        'dbfield' => 'classic_fb_link',
        'label' => __('Facebook URL'),
        'type' => 'longtext',
        'default' => 'https://www.facebook.com/groups/senayan.slims',
        'width' => '100',
        'max' => 1000
    ],
    'twitter-link' => [
        'dbfield' => 'classic_twitter_link',
        'label' => __('Twitter URL'),
        'type' => 'longtext',
        'default' => 'https://twitter.com/slims_official',
        'width' => '100',
        'max' => 1000
    ],
    'youtube-link' => [
        'dbfield' => 'classic_youtube_link',
        'label' => __('Youtube URL'),
        'type' => 'longtext',
        'default' => 'https://youtube.com',
        'width' => '100',
        'max' => 1000
    ],
    'instagram-link' => [
        'dbfield' => 'classic_instagram_link',
        'label' => __('Instagram URL'),
        'type' => 'longtext',
        'default' => 'https://www.instagram.com/slims.sdc',
        'width' => '100',
        'max' => 1000
    ],
    'footer_about_us' => [
        'dbfield' => 'classic_footer_about_us',
        'label' => __('Footer About Us'),
        'type' => 'ckeditor',
        'default' => '<p>Layanan perpustakaan terpadu. Berkomitmen menyediakan akses pengetahuan bagi civitas akademika.</p>',
    ],
    'visitor_voice' => [
        'dbfield' => 'visitor_log_voice',
        'label' => __('Visitor log voice'),
        'type' => 'dropdown',
        'default' => 1,
        'data' => [
            [1, __('Enable')],
            [0, __('Disable')]
        ]
    ],
];
