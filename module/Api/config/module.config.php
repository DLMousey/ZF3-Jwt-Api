<?php

namespace Api;

use Zend\ServiceManager\Factory\InvokableFactory;

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
            'refresh' => [
                'type' => 'literal',
                'options' => [
                    'route' => '/refresh',
                    'defaults' => [
                        'controller' => Controller\RefreshController::class
                    ],
                ],
            ],
            'protected' => [
                'type' => 'literal',
                'options' => [
                    'route' => '/protected',
                    'defaults' => [
                        'controller' => Controller\ProtectedResourceController::class
                    ],
                ],
            ],
            'unprotected' => [
                'type' => 'literal',
                'options' => [
                    'route' => '/unprotected',
                    'defaults' => [
                        'controller' => Controller\UnprotectedResourceController::class
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\LoginController::class => Factory\LoginControllerFactory::class,
            Controller\RefreshController::class => Factory\RefreshControllerFactory::class,
            Controller\UnprotectedResourceController::class => InvokableFactory::class,
            Controller\ProtectedResourceController::class => InvokableFactory::class
        ],
    ],
    'view_manager' => [
        'strategies' => [
            'ViewJsonStrategy'
        ]
    ],
    'access-control' => [
        ['route' => '/refresh', 'protected' => false],
        ['route' => '/login', 'protected' => false],
        ['route' => '/unprotected', 'protected' => false],
        ['route' => '/protected', 'protected' => true]
    ]
];