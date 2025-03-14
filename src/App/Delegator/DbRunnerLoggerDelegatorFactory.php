<?php

namespace App\Delegator;

use Laminas\Db\Adapter\AdapterInterface;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;

class DbRunnerLoggerDelegatorFactory
{
    public function __invoke(ContainerInterface $container, string $name, callable $callback): DbRunnerLogger
    {
        $db = $container->get(AdapterInterface::class);
        $logger = $container->get(LoggerInterface::class);
        
        $dbRunnerLogger = new DbRunnerLogger($db);
        $dbRunnerLogger->setLogger($logger);

        return $dbRunnerLogger;
    }
}
