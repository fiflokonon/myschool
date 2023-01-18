<?php

namespace App\Domain\Motif\Repository;

use PDO;

final class MotifRepository extends \App\Domain\Core\Repository\Repository
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
    public function motifs()
    {
        return $this->getAll('motifs');
    }

    /**
     * @param int $id
     * @return mixed|null
     */
    public function motif(int $id)
    {
        return $this->getOne('motifs', $id);
    }

    /**
     * @param int $id
     * @return array|false|mixed|string
     */
    public function deleteMotif(int $id)
    {
        return $this->deleteOne('motifs', $id);
    }

    public function createMotif(array $motif)
    {
        $motif_nom = htmlspecialchars($motif['motif']);
        $montant_motif = htmlspecialchars($motif['montant_motif']);
    }
}