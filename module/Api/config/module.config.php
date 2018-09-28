<?php

namespace Api;

return [
    'router' => [
        'routes' => [
            'login' => [
                'type' => 'literal',
                'options' => [
                    'route' => '/login',
                    'defaults' => [
                        'controller' => Controller\LoginController::class
                    ],
                ],
            ]
        ]
    ],
    'controllers' => [
        'factories' => [
            Controller\LoginController::class => Factory\LoginControllerFactory::class
        ],
    ],
    'view_manager' => [
        'strategies' => [
            'ViewJsonStrategy'
        ]
    ]
];