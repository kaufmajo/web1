<?php

declare(strict_types=1);

namespace App\Model;

use App\Model\Entity\AbstractEntity;
use App\Model\Entity\EntityHydratorInterface;
use App\Model\Entity\EntityInterface;
use App\Model\Termin\TerminEntityInterface;
use Doctrine\DBAL\Connection;
use Laminas\Db\ResultSet\HydratingResultSet;
use Laminas\Db\ResultSet\ResultSet;
use Laminas\Db\Sql\SqlInterface;
use Laminas\Hydrator\HydratorInterface;

use function in_array;

abstract class AbstractRepository implements RepositoryInterface
{
    protected Connection $dbalConnection;

    protected DbRunnerInterface $dbRunner;

    private EntityHydratorInterface $entityHydrator;

    protected HydratorInterface $hydrator;

    protected EntityInterface $prototype;

    public function __construct(Connection $dbalConnection, DbRunnerInterface $dbRunner, EntityHydratorInterface $entityHydrator, HydratorInterface $hydrator, AbstractEntity $prototype)
    {
        $this->dbalConnection  = $dbalConnection;
        $this->dbRunner  = $dbRunner;
        $this->entityHydrator  = $entityHydrator;
        $this->hydrator  = $hydrator;
        $this->prototype = $prototype;
    }

    public function getDbRunner(): DbRunnerInterface
    {
        return $this->dbRunner;
    }

    public function setHydrator(HydratorInterface $hydrator)
    {
        $this->hydrator = $hydrator;
    }

    public function setPrototype(AbstractEntity $prototype)
    {
        $this->prototype = $prototype;
    }

    public function hydrateEntity(array $data): TerminEntityInterface
    {
        return $this->entityHydrator->hydrate($data, clone $this->prototype);
    }

    public function extractEntity(TerminEntityInterface $entity): array
    {
        return $this->entityHydrator->extract($entity);
    }

    public function find(SqlInterface|string $select): HydratingResultSet
    {
        $result = $this->dbRunner->executeSelect($select);

        $resultSet = new HydratingResultSet($this->hydrator, $this->prototype);

        $resultSet->initialize($result);

        return $resultSet;
    }

    public function findFirst(SqlInterface|string $select): ?EntityInterface
    {
        $result = $this->find($select)->current();

        return ! $result instanceof EntityInterface ? null : $result;
    }

    public function fetch(SqlInterface|string $select): ResultSet
    {
        $result = $this->dbRunner->executeSelect($select);

        $resultSet = new ResultSet();

        $resultSet->initialize($result);

        return $resultSet;
    }

    public function isParamValid(array $params, string $key, array $falseValue = [null, '']): bool
    {
        if (! isset($params[$key])) {
            return false;
        }

        if (in_array($params[$key], $falseValue, true)) {
            return false;
        }

        return true;
    }
}
