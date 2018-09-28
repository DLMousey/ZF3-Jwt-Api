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
        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\LoginController::class => Factory\LoginControllerFactory::class,
            Controller\VerificationController::class => Factory\VerificationControllerFactory::class
        ],
    ],
    'view_manager' => [
        'strategies' => [
            'ViewJsonStrategy'
        ]
    ]
];