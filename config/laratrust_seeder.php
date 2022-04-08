<?php

return [
    /**
     * Control if the seeder should create a user per role while seeding the data.
     */
    'create_users' => false,

    /**
     * Control if all the laratrust tables should be truncated before running the seeder.
     */
    'truncate_tables' => true,

    'roles_structure' => [
        'admin' => [
            'users' => 'c,r,u,d',
            'profile' => 'r,u',
            'req' => 'c,r,u,d'
        ],
        'engr' => [
            'users' => 'c,r,u,d',
            'profile' => 'r'
        ],
        'hr' => [
            'profile' => 'r,u',
            'req' => 'c,u'
        ],
        'user' => [
            'profile' => 'r',
            'req' => 'c,u'
        ]
    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];
