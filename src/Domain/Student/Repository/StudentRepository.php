<?php

namespace App\Domain\Student\Repository;

use PDO;
use Slim\Exception\HttpException;

class StudentRepository extends \App\Domain\Core\Repository\Repository
{
    public function __construct(PDO $connection)
    {
        parent::__construct($connection);
    }

    /**
     * @return array|false
     */
    public function students()
    {
        return $this->getAll('eleves');
    }

    /**
     * @param int $id
     * @return mixed|null
     */
    public function student(int $id)
    {
        return $this->getOne('eleves', $id);
    }

    public function createStudent(array $student)
    {
        $nom = htmlspecialchars($student['nom']);
        $prenoms = htmlspecialchars($student['prenoms']);
        $id_classe = htmlspecialchars($student['id_classe']);
        $nom_prenoms_pere = htmlspecialchars($student['nom_prenoms_pere']);
        $nom_prenoms_mere = htmlspecialchars($student['nom_prenoms_mere']);
        $sql_check = "SELECT * FROM eleves WHERE nom = $nom AND prenoms = $prenoms";
        $check = $this->connection->query($sql_check)->fetchAll();
        if (empty($check))
        {
            $sql = "INSERT INTO eleves(prenoms, nom, id_classe, nom_prenoms_pere, nom_prenoms_mere) VALUES (:prenoms, :nom, :id_classe, :nom_prenoms_pere, :nom_prenoms_mere)";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue('nom', $nom);
            $stmt->bindValue('prenoms', $prenoms);
            $stmt->bindValue('id_classe', $id_classe);
            $stmt->bindValue('nom_prenoms_pere', $nom_prenoms_pere);
            $stmt->bindValue('nom_prenoms_mere', $nom_prenoms_mere);
            try {
                if ($stmt->execute())
                {
                    $sql_eleve1 = "SELECT * FROM eleves WHERE nom = $nom AND prenoms = $prenoms AND id_classe = $id_classe LIMIT 1";
                    $eleve1 = $this->connection->query($sql_eleve1)->fetchAll(PDO::FETCH_OBJ)[0];
                    $matricule = $this->generateMatricule($id_classe, $nom, $eleve1['id']);
                    $sql_update = "UPDATE eleves SET matricule = '$matricule' WHERE id = $eleve1->id";
                    if ($this->connection->prepare($sql_update)->execute())
                    {
                        $sql_last = "SELECT * FROM eleves WHERE id = $eleve1->id LIMIT 1";
                        return [
                            "success" => true,
                            "response" => $this->connection->query($sql_last)->fetchAll()[0]
                         ];
                    }
                }
            }catch (HttpException $exception)
            {
                return [
                    "success" => false,
                    "message" => $exception->getMessage()
                ];
            }

        }
        else
        {
            return [
                "success" => false,
                "message" => "Un élève du meme nom et prenoms existe"
            ];
        }
    }

    public function studentsBySchool(int $schoolId) {
        $query = "SELECT eleves.* FROM eleves
              JOIN classes ON eleves.id_classe = classes.id
              JOIN ecoles ON classes.id_ecole = ecoles.id
              WHERE ecoles.id = :schoolId";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam("schoolId", $schoolId);
        try {
            $stmt->execute();
            $students = $stmt->fetchAll(PDO::FETCH_OBJ);
            return [
                "success" => true,
                "response" => $students
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


    public function classStudents(int $id_classe)
    {
        $sql = "SELECT * FROM eleves WHERE id_classe = $id_classe";
        try {
            $students = $this->connection->query($sql)->fetchAll();
            return [
                "success" => true,
                "response" => $students
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
     * @return array|false|mixed|string
     */
    public function deleteStudent(int $id)
    {
        return $this->deleteOne('eleves', $id);
    }

    public function generateMatricule(string $classId, string $name, int $id)
    {
        $school = $this->getSchoolByClass($classId);
        $school_prefix = $school->id_slug;
        $string1 = $this->generateStringId($name, $id);
        return $school_prefix.$string1;
    }

    public function getSchoolByClass(int $classId) {
        $query = "SELECT ecoles.* FROM ecoles
              JOIN classes ON ecoles.id = classes.id_ecole
              WHERE classes.id = :classId";
        $stmt = $this->connection->prepare($query);
        $stmt->bindValue(':classId', $classId);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

}