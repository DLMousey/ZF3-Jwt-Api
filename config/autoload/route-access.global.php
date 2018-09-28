<?php

return [
    'route-guards' => [
        [
            'route' => '/login',
            'protected' => false
        ],
        [
            'route' => '/refresh',
            'protected' => true
        ],
        [
            'route' => '/verify',
            'protected' => true
        ]
    ]
];