<?php

if(!isset($dbParams))
    require 'database.local.php';

return [
    'doctrine' => [
        'connection' => [
            'orm_default' => [
                'driverClass' => 'Doctrine\DBAL\Driver\PDOMySql\Driver',
                'params' => [
                    'host' => $dbParams['hostname'],
                    'port' => 3306,
                    'user' => $dbParams['username'],
                    'password' => $dbParams['password'],
                    'dbname' => $dbParams['database']
                ]
            ]
        ]
    ]
];