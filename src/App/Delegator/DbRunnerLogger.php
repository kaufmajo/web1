<?php

namespace App\Delegator;

use App\Model\DbRunner;
use App\Traits\Aware\LoggerAwareTrait;
use Laminas\Db\Adapter\Adapter;
use Laminas\Db\Adapter\Driver\ResultInterface;
use Laminas\Db\Sql\SqlInterface;

class DbRunnerLogger extends DbRunner
{
    use LoggerAwareTrait;

    protected bool $logging = false;

    public function __construct(Adapter $db)
    {
        parent::__construct($db);
    }

    protected function logSql(SqlInterface|string $query): void
    {
        if (! $this->logging) {

            return;
        }

        if (is_string($query)) {

            $this->getLogger()->debug($query);
        } else {

            $this->getLogger()->debug($query->getSqlString($this->db->getPlatform()));
        }
    }

    public function executeCommand(SqlInterface|string $command): ResultInterface
    {
        $this->logSql($command);

        return parent::executeSql($command);
    }

    public function executeSelect(SqlInterface|string $select): ?ResultInterface
    {
        $this->logSql($select);

        return parent::executeSelect($select);
    }

    public function executeSql(SqlInterface|string $query): ResultInterface
    {
        $this->logSql($query);

        return parent::executeSql($query);
    }
}
