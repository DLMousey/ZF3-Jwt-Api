<?php

return [
    'route-guards' => [
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