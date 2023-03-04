<?php

namespace App\Domain\Demand\Repository;

use PDO;
use Slim\Exception\HttpException;

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

    public function schoolDemands(int $id_ecole)
    {
        $sql = "SELECT * FROM demandes WHERE id_ecole = $id_ecole";

        try {
            $demands = $this->connection->query($sql)->fetchAll();
            return [
                "success" => true,
                "response" => $demands
            ];
        }catch (HttpException $exception)
        {
            return [
                "success" => false,
                "message" => $exception->getMessage()
            ];
        }
    }

    /**
     * @param int $id_ecole
     * @return array|false|mixed|string
     */
    public function deleteSchoolDemands(int $id_ecole)
    {
        $sql = "DELETE FROM demandes WHERE id_ecole = $id_ecole";
        $stmt = $this->connection->prepare($sql);
        return $this->exeStatement($stmt, ["success" => true, "message" => "Ecoles supprimées"]);
    }

    /**
     * @param int $id
     * @return array|false|mixed|string
     */
    public function changeDemandStatus(int $id)
    {
        $sql = "UPDATE demandes SET statut = true WHERE id = $id";
        $stmt = $this->connection->prepare($sql);
        return $this->exeStatement($stmt, ["success" => true, "message" => "Statut changé"]);
    }

    public function readMessages()
    {
        $sql = "SELECT * FROM demandes WHERE statut = true";
        try {
            $demands = $this->connection->query($sql)->fetchAll();
            return [
                "success" => true,
                "response" => $demands
            ];
        }
        catch (HttpException $exception)
        {
            return  [
                "success" => false,
                "message" => $exception->getMessage()
            ];
        }
    }

    /**
     * @return array
     */
    public function unreadMessages()
    {
        $sql = "SELECT * FROM demandes WHERE statut = false";
        try {
            $demands = $this->connection->query($sql)->fetchAll();
            return [
                "success" => true,
                "response" => $demands
            ];
        }
        catch (HttpException $exception)
        {
            return  [
                "success" => false,
                "message" => $exception->getMessage()
            ];
        }
    }

    /**
     * @param int $id_ecole
     * @return array
     */
    public function schoolReadMessages(int $id_ecole)
    {
        $sql = "SELECT * FROM demandes WHERE statut = true AND id_ecole = $id_ecole";
        try {
            $demands = $this->connection->query($sql)->fetchAll();
            return [
                "success" => true,
                "response" => $demands
            ];
        }
        catch (HttpException $exception)
        {
            return  [
                "success" => false,
                "message" => $exception->getMessage()
            ];
        }
    }

    /**
     * @param int $id_ecole
     * @return array
     */
    public function schoolUnreadMessages(int $id_ecole)
    {
        $sql = "SELECT * FROM demandes WHERE statut = false AND id_ecole = $id_ecole";
        try {
            $demands = $this->connection->query($sql)->fetchAll();
            return [
                "success" => true,
                "response" => $demands
            ];
        }
        catch (HttpException $exception)
        {
            return  [
                "success" => false,
                "message" => $exception->getMessage()
            ];
        }

    }

    /**
     * @param int $id_ecole
     * @return array
     */
    public function deleteSchoolReadMessages(int $id_ecole)
    {
        $sql = "DELETE FROM demandes WHERE statut = true AND id_ecole = $id_ecole";
        try {
            $demands = $this->connection->query($sql)->fetchAll();
            return [
                "success" => true,
                "response" => "Messages supprimés"
            ];
        }
        catch (HttpException $exception)
        {
            return  [
                "success" => false,
                "message" => $exception->getMessage()
            ];
        }
    }

}