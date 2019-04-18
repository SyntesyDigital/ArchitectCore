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
        "route" => 'rrhh.admin.offers.index',
        "label" => 'rrhh::header.offers',
        "patterns" => [
            'architect/offers*',
            'architect/tags*'
        ],
        "roles" => []
    ],

    /*
    [
        'group' => true,
        'name' => 'architect::plugins.topbar.menu'
    ],

    [
        "route" => 'rrhh.admin.candidates.index',
        "label" => 'rrhh::header.candidates',
        "patterns" => [
            'architect/candidates*'
        ],
        "roles" => ['admin']
    ],
    [
        "route" => 'rrhh.admin.customers.index',
        "label" => 'rrhh::header.customers',
        "patterns" => [
            'architect/customers*'
        ],
        "roles" => ['admin']
    ],    */
    [
        "route" => 'contents',
        "label" => 'architect::header.contents',
        "patterns" => [
            'architect/contents*'
        ],
        "roles" => ['admin']
    ],
    [
        "route" => 'documents.index',
        "label" => 'documents::header.documents',
        "patterns" => [
            'architect/documents*'
        ],
        "roles" => ['admin']
    ],

  /*  [
        "route" => 'medias.index',
        "label" => 'architect::header.media',
        "patterns" => [
            'architect/medias*'
        ],
        "roles" => ['admin']
    ],
*/
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
