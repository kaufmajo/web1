<?php

use Doctrine\DBAL\DriverManager;
use Psr\Container\ContainerInterface;

return [
    'doctrine' => [
        'connection' => [
            'dbname'   => 'evangel3_egli1',
            'driver'   => 'pdo_mysql',
            // add charset, port, etc. as needed
        ],
    ],

    'dependencies' => [
        'factories' => [
            \Doctrine\DBAL\Connection::class => function (ContainerInterface $container) {
                $config = $container->get('config')['doctrine']['connection'];
                return DriverManager::getConnection($config);
            },
        ],
    ],
];