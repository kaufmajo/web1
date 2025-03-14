<?php

declare(strict_types=1);

namespace App\Model;

use App\Model\Entity\EntityInterface;
use Laminas\Db\ResultSet\HydratingResultSet;
use Laminas\Db\ResultSet\ResultSet;
use Laminas\Db\Sql\SqlInterface;

interface RepositoryInterface
{
    public function getDbRunner(): DbRunnerInterface;

    public function mapReferences(?EntityInterface $entity): ?EntityInterface;

    public function find(SqlInterface|string $select): HydratingResultSet;

    public function findFirst(SqlInterface|string $select);

    public function fetch(SqlInterface|string $select): ResultSet;
}
