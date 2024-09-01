<?php

declare(strict_types=1);

namespace App\Handler\Home\Def;

use App\Handler\AbstractBaseHandlerFactory;
use Laminas\Db\Adapter\AdapterInterface;
use Psr\Container\ContainerInterface;

class CleanupHandlerFactory extends AbstractBaseHandlerFactory
{
    public function __invoke(ContainerInterface $container): CleanupHandler
    {
        $handler = new CleanupHandler();

        // db adapter
        $handler->setDatabaseAdapter($container->get(AdapterInterface::class));

        parent::init($handler, $container);

        return $handler;
    }
}
