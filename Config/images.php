<?php

return [
    'storage_directory' => 'public/medias',

    'display' => 'thumbnail',

    'formats' => [
        [
            'name' => 'large',
            'directory' => 'large',
            'ratio' => '',
            'width' => 1280,
            'height' => 750
        ],
        [
            'name' => 'square',
            'directory' => 'square',
            'ratio' => '1:1',
            'width' => 500,
            'height' => 500
        ],
        [
            'name' => 'vertical',
            'directory' => 'vertical',
            'ratio' => '',
            'width' => 400,
            'height' => 540
        ],
        [
            'name' => 'horizontal',
            'directory' => 'horizontal',
            'ratio' => '',
            'width' => 540,
            'height' => 400
        ],
        [
            'name' => 'thumbnail',
            'directory' => 'thumbnail',
            'ratio' => '1:1',
            'width' => 90,
            'height' => 90
        ]
    ]

];
