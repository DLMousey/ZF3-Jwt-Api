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
            ],
            'verify' => [
                'type' => 'literal',
                'options' => [
                    'route' => '/verify',
                    'defaults' => [
                        'controller' => Controller\VerificationController::class
                    ],
                ],
            ],
            'refresh' => [
                'type' => 'literal',
                'options' => [
                    'route' => '/refresh',
                    'defaults' => [
                        'controller' => Controller\RefreshController::class
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\LoginController::class => Factory\LoginControllerFactory::class,
            Controller\VerificationController::class => Factory\VerificationControllerFactory::class,
            Controller\RefreshController::class => Factory\RefreshControllerFactory::class
        ],
    ],
    'view_manager' => [
        'strategies' => [
            'ViewJsonStrategy'
        ]
    ]
];