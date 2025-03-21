<?php

declare(strict_types=1);

namespace App\Model;

use App\Model\Entity\EntityInterface;
use Laminas\Db\Sql\Delete;
use Laminas\Db\Sql\Insert;
use Laminas\Db\Sql\Update;

interface CommandInterface
{
    public function getEntityData(EntityInterface $entity);

    public function insert(Insert|string $insert, int &$generatedValue): int;

    public function update(Update|string $update): int;

    public function delete(Delete|string $delete): int;
}
