<?php

namespace Core;

return [
    'doctrine' => [
        'driver' => [
            'core_driver' => [
                'class' => \Doctrine\ORM\Mapping\Driver\XmlDriver::class,
                'paths' => __DIR__ . '/xml/entities'
            ],
            'orm_default' => [
                'drivers' => [
                    'Core\Entity' => 'core_driver'
                ]
            ]
        ]
    ],
    'service_manager' => [
        'aliases' => [
            'core_user_service' => Service\UserService::class,
            'core_jwt_service' => Service\JwtService::class,
            'core_refresh_token_service' => Service\RefreshTokenService::class
        ],
        'factories' => [
            Service\UserService::class => Factory\UserServiceFactory::class,
            Service\JwtService::class => Factory\JwtServiceFactory::class,
            Service\RefreshTokenService::class => Factory\RefreshTokenServiceFactory::class
        ]
    ]
];

