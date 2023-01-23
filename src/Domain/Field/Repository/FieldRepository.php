<?php

namespace App\Domain\Field\Repository;

use PDO;
use Slim\Exception\HttpException;

class FieldRepository extends \App\Domain\Core\Repository\Repository
{
    public function __construct(PDO $connection)
    {
        parent::__construct($connection);
    }

    /**
     * @return array|false
     */
    public function matieres()
    {
        return $this->getAll('matieres');
    }

    /**
     * @param int $id
     * @return mixed|null
     */
    public function matiere(int $id)
    {
        return $this->getOne('matieres', $id);
    }

    /**
     * @param array $field
     * @return array|false|mixed|string
     */
    public function createMatiere(array $field)
    {
        $matiere = htmlspecialchars($field['matiere']);
        $id_ecole = htmlspecialchars($field['id_ecole']);
        $check_request = "SELECT * FROM matieres WHERE id_ecole = $id_ecole AND matiere = $matiere";
        try {
            $check = $this->connection->query($check_request)->fetchAll();
            if (empty($check))
            {
                $sql = "INSERT INTO matieres(matiere, id_ecole) VALUES (:matiere, :id_ecole)";
                $stmt = $this->connection->prepare($sql);
                $stmt->bindValue('matiere', $matiere);
                $stmt->bindValue('id_ecole', $id_ecole);
                return $this->exeStatement($stmt, ["success" => true, "message" => "Matière ajoutée"]);
            }
            else
            {
                return ["success" => false, "message" => "Cette matière existe déjà dans l'école"];
            }
        }
        catch (HttpException $exception)
        {
            return ["success" => false, "message" => $exception->getMessage()];
        }
    }

    public function schoolMatieres(int $id_ecole)
    {
        $sql = "SELECT * FROM matieres WHERE id_ecole = $id_ecole";
        try {
            $fields = $this->connection->query($sql)->fetchAll();
            return [
                "success" => true,
                "response" => $fields
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
     * @param int $id_ecole
     * @return array|false|mixed|string
     */
    public function deleteSchoolMatieres(int $id_ecole)
    {
        $sql = "DELETE FROM matieres WHERE id_ecole = $id_ecole";
        $stmt = $this->connection->prepare($sql);
        return $this->exeStatement($stmt, ["success" => true, "message" => "Matières supprimées"]);
    }
    /**
     * @param int $id
     * @return array|false|mixed|string
     */
    public function deleteField(int $id)
    {
        return $this->deleteOne('matieres', $id);
    }
}