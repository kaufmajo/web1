<?php

declare(strict_types=1);

namespace App\Handler\Home\Mng;

use App\Model\DbRunnerInterface;
use App\Handler\AbstractBaseHandlerFactory;
use Psr\Container\ContainerInterface;

class HomeStatsHandlerFactory extends AbstractBaseHandlerFactory
{
    public function __invoke(ContainerInterface $container): HomeStatsHandler
    {
        $page = new HomeStatsHandler();

        parent::init($page, $container);

        // dbRunner
        $dbRunner = $container->get(DbRunnerInterface::class);

        $page->setDbRunner($dbRunner);

        return $page;
    }
}
