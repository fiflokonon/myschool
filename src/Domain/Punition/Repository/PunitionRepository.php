<?php

namespace App\Domain\Punition\Repository;

use App\Domain\Core\Repository\Repository;
use PDO;
use Slim\Exception\HttpException;

class PunitionRepository extends Repository
{
    public function __construct(PDO $connection)
    {
        parent::__construct($connection);
    }

    public function punitions()
    {
        return $this->getAll('punitions');
    }

    public function punition(int $id)
    {
        return $this->getOne('punitions', $id);
    }

    public function getAllStudentPunitions(int $id)
    {
        $sql = "SELECT * FROM punitions WHERE id_eleve = $id";
        try {
            $punitions = $this->connection->query($sql)->fetchAll();
            return[
                "success" => true,
                "response" => $punitions
            ];
        }
        catch (HttpException $exception)
        {
            return [
                "success" => false,
                "message" => $exception->getMessage()
            ];
        }
    }

    /**
     * @param int $id
     * @param int $id_field
     * @return array
     */
    public function getStudentPunitionsByField(int $id, int $id_field)
    {
        $sql_matiere = "SELECT * FROM matieres WHERE id = $id_field LIMIT 1";
        $sql_notes = "SELECT * FROM punitions WHERE id_eleve = $id AND id_matiere = $id_field";
        try {
            $punitions = $this->connection->query($sql_notes)->fetchAll();
            $matiere = $this->connection->query($sql_matiere)->fetchAll()[0];
            return [
                "success" => true,
                "response" => [
                    "matiere" => $matiere['matiere'],
                    "punitions" => $punitions
                ]
            ];
        }
        catch (HttpException $exception)
        {
            return [
                "success" => false,
                "message" => $exception->getMessage()
            ];
        }
    }

    /**
     * @param array $punition
     * @return array|false|mixed|string
     */
    public function createPunition(array $punition)
    {
        $_punition = htmlspecialchars($punition['note']);
        $id_eleve = htmlspecialchars($punition['id_eleve']);
        $id_matiere = htmlspecialchars($punition['id_matiere']);
        $motif = htmlspecialchars($punition['motif']);
        $date = htmlspecialchars($punition['date']);
        $sql = "INSERT INTO punitions(id_matiere, motif, punition, id_eleve, date) VALUES (:id_matiere, :motif, :punition, :id_eleve, :date)";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue('id_eleve', $id_eleve);
        $stmt->bindValue('motif', $motif);
        $stmt->bindValue('punition', $_punition);
        $stmt->bindValue('id_matiere', $id_matiere);
        $stmt->bindValue('date', $date);
        return $this->exeStatement($stmt, ['success' => true, "message" => "Punition ajoutée"]);
    }

    /**
     * @param int $id
     * @return array|false|mixed|string
     */
    public function deletePunition(int $id)
    {
        return $this->deleteOne('punitions', $id);
    }
}