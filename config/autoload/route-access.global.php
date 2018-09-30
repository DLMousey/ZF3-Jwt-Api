<?php

return [
    'route-guards' => [
        [
            'route' => '/protected',
            'protected' => true
        ],
        [
            'route' => '/unprotected',
            'protected' => false
        ],
        [
            'route' => '/login',
            'protected' => false
        ],
        [
            'route' => '/refresh',
            'protected' => false
        ],
        [
            'route' => '/verify',
            'protected' => true,
            'roles' => ['user', 'administrator']
        ]
    ]
];