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

    /***
     * @param array $demand
     * @return array|false|mixed|string
     */
    public function createDemand(array $demand)
    {
        $id_utilisateur = htmlspecialchars($demand['id_utilisateur']);
        $message = htmlspecialchars($demand['message']);
        $id_ecole = htmlspecialchars($demand['id_ecole']);
        $sql = "INSERT INTO demandes(id_utilisateur, id_ecole, message) VALUES (:id_utilisateur, :id_ecole, :message)";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue('id_utilisateur', $id_utilisateur);
        $stmt->bindValue('id_ecole', $id_ecole);
        $stmt->bindValue('message', $message);
        return $this->exeStatement($stmt, ['success' => true, "message" => "Demande Enregistrée"]);
    }
}