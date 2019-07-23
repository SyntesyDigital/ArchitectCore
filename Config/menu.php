<?php

return [
    [
        "route" => 'dashboard',
        "label" => 'architect::header.home',
        "patterns" => [
            'architect'
        ],
        "roles" => []
    ],

    [
        "route" => 'customers.index',
        "label" => 'pepetteadmin::header.orders',
        "patterns" => [
            'architect/orders*'
        ],
        "roles" => ['admin']
    ],

    [
        "route" => 'contents',
        "label" => 'architect::header.contents',
        "patterns" => [
            'architect/contents*'
        ],
        "roles" => ['admin']
    ],

    [
        "route" => 'medias.index',
        "label" => 'architect::header.media',
        "patterns" => [
            'architect/medias*'
        ],
        "roles" => ['admin']
    ],

    [
        "route" => 'settings',
        "label" => 'architect::header.configuration',
        "patterns" => [
            'architect/settings*'
        ],
        "roles" => [
            'admin'
        ]
    ],
];
