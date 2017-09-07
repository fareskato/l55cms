<?php

return [
    'role_structure' => [
        'administrator' => [
            'users' => 'c,r,u,d',
            'acl' => 'c,r,u,d',
            'profile' => 'c,r,u,d',
            'posts' => 'c,r,u,d',
            'categories' => 'c,r,u,d',
            'tags' => 'c,r,u,d',
            'pages' => 'c,r,u,d',
            'menus' => 'c,r,u,d',
            'wedgits' => 'c,r,u,d',
            'comments' => 'c,r,u,d',
        ],
        'editor' => [
            'profile' => 'r,u',
            'posts' => 'c,r,u,d',
            'categories' => 'c,r,u,d',
            'tags' => 'c,r,u,d',
            'pages' => 'c,r,u,d',
            'menus' => 'c,r,u,d',
            'wedgits' => 'c,r,u,d',
            'comments' => 'c,r,u,d',
        ],
        'author' => [
            'profile' => 'c,r,u'
        ],
    ],
    'permission_structure' => [],
    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];
