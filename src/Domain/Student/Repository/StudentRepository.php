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
}