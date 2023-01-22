<?php

namespace App\Domain\Classe\Repository;

use PDO;

class ClassRepository extends \App\Domain\Core\Repository\Repository
{
    public function __construct(PDO $connection)
    {
        parent::__construct($connection);
    }
}