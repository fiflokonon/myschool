<?php

namespace App\Domain\Demand\Repository;

use PDO;

final class DemandRepository extends \App\Domain\Core\Repository\Repository
{
    /**
     * @param PDO $connection
     */
    public function __construct(PDO $connection)
    {
        parent::__construct($connection);
    }

    /**
     * @return array|false
     */
    public function demands()
    {
        return $this->getAll('demandes');
    }

    /**
     * @param int $id
     * @return mixed|null
     */
    public function demand(int $id)
    {
        return $this->getOne('demandes', $id);
    }

    /**
     * @param int $id
     * @return array|false|mixed|string
     */
    public function deleteDemand(int $id)
    {
        return $this->deleteOne('demandes', $id);
    }

    public function createDemand(array $demand)
    {

    }
}