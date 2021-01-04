<?php

return [
    'name' => 'VIMFile',
    'manifest' => [
        'name' => env('APP_NAME', 'VIMFile'),
        'short_name' => 'VIMFile',
        'start_url' => '/',
        'background_color' => '#ffffff',
        'theme_color' => '#4A90E2',
        'display' => 'standalone',
        'orientation'=> 'any',
        'icons' => [
            '72x72' => '/images/icons/vimfile.jpg',
            '96x96' => '/images/icons/vimfile.jpg',
            '128x128' => '/images/icons/vimfile.jpg',
            '144x144' => '/images/icons/vimfile.jpg',
            '152x152' => '/images/icons/vimfile.jpg',
            '192x192' => '/images/icons/vimfile.jpg',
            '384x384' => '/images/icons/vimfile.jpg',
            '512x512' => '/images/icons/vimfile.jpg'
        ],
        'splash' => [
            '640x1136' => '/images/icons/vimfile.jpg',
            '750x1334' => '/images/icons/vimfile.jpg',
            '828x1792' => '/images/icons/vimfile.jpgg',
            '1125x2436' => '/images/icons/vimfile.jpg',
            '1242x2208' => '/images/icons/vimfile.jpg',
            '1242x2688' => '/images/icons/vimfile.jpg',
            '1536x2048' => '/images/icons/vimfile.jpg',
            '1668x2224' => '/images/icons/vimfile.jpg',
            '1668x2388' => '/images/icons/vimfile.jpg',
            '2048x2732' => '/images/icons/vimfile.jpg',
        ],
        'custom' => [
            'tag_name' => 'Vehicle Inspection & Maintenance',
        ]
    ]
];
