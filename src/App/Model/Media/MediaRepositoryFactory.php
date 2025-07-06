<?php

declare(strict_types=1);

namespace App\Model\Media;

use App\Model\DbRunnerInterface;
use Doctrine\DBAL\Connection;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;

class MediaRepositoryFactory implements FactoryInterface
{
    /**
     * @param string $requestedName
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null): MediaRepository
    {
        // dbalConnection
        $dbalConnection = $container->get(Connection::class);

        // dbRunner
        $dbRunner = $container->get(DbRunnerInterface::class);

        return new MediaRepository(
            $dbalConnection,
            $dbRunner,
            new MediaEntityHydrator(),
            new MediaReflectionHydrator(),
            new MediaEntity()
        );
    }
}
