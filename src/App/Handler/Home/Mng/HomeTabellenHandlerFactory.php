<?php

declare(strict_types=1);

namespace App\Handler\Home\Mng;

use App\Model\DbRunnerInterface;
use App\Handler\AbstractBaseHandlerFactory;
use Psr\Container\ContainerInterface;

class HomeTabellenHandlerFactory extends AbstractBaseHandlerFactory
{
    public function __invoke(ContainerInterface $container): HomeTabellenHandler
    {
        $page = new HomeTabellenHandler();

        parent::init($page, $container);

        // dbRunner
        $dbRunner = $container->get(DbRunnerInterface::class);

        $page->setDbRunner($dbRunner);

        return $page;
    }
}
