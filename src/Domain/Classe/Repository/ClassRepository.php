<?php

namespace App\Domain\Classe\Repository;

use PDO;
use Slim\Exception\HttpException;

class ClassRepository extends \App\Domain\Core\Repository\Repository
{
    public function __construct(PDO $connection)
    {
        parent::__construct($connection);
    }

    public function classes()
    {
        return $this->getAll('classes');
    }

    public function classe(int $id)
    {
        return $this->getOne('classes', $id);
    }

    public function createClasse(array $classe)
    {
        $nom = htmlspecialchars($classe['nom']);
        $scolarite = htmlspecialchars($classe['scolarite']);
        $id_ecole = htmlspecialchars($classe['id_ecole']);
        $sql = "INSERT INTO classes(nom, scolarite, id_ecole) VALUES (:nom, :scolarite, :id_ecole)";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue('nom', $nom);
        $stmt->bindValue('scolarite', $scolarite);
        $stmt->bindValue('id_ecole', $id_ecole);
        return $this->exeStatement($stmt, ['success' => true, "message" => "Classe créée"]);
    }

    public function schoolClasses(int $id_ecole)
    {
        $sql = "SELECT * FROM classes WHERE id_ecole = $id_ecole";
        try {
            $classes = $this->connection->query($sql)->fetchAll();
            return [
                "success" => true,
                "response" => $classes
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

    public function deleteSchoolClasses(int $id_ecole)
    {
        $sql = "DELETE FROM classes WHERE id_ecole = $id_ecole";
        $stmt = $this->connection->prepare($sql);
        return $this->exeStatement($stmt, ['success' => true, "message" => "Classes suppriméees"]);
    }

    public function deleteClasse(int $id)
    {
        return $this->deleteOne('classes', $id);
    }
}