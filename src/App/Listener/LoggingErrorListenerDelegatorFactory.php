<?php

namespace App\Listener;

use Psr\Container\ContainerInterface;
use Laminas\Log\LoggerInterface;
// use Psr\Log\LoggerInterface;
use Laminas\Stratigility\Middleware\ErrorHandler;

class LoggingErrorListenerDelegatorFactory
{
    public function __invoke(ContainerInterface $container, string $name, callable $callback): ErrorHandler
    {
        $listener = new LoggingErrorListener($container->get('AppLogger')); // LoggerInterface::class - 'AppLogger'
        $errorHandler = $callback();
        $errorHandler->attachListener($listener);
        return $errorHandler;
    }
}
