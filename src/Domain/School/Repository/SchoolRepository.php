<?php

namespace App\Domain\School\Repository ;


use PDO;
use Slim\Exception\HttpException;

final class SchoolRepository extends \App\Domain\Core\Repository\Repository
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
    public function schools()
    {
        return $this->getAll('schools');
    }

    public function createSchool(array $school)
    {
        $nom = htmlspecialchars($school['nom']);
        $email = htmlspecialchars($school['email']);
        $contact = htmlspecialchars($school['contact']);
        $adresse = htmlspecialchars($school['adresse']);
        $sql = "SELECT * FROM ecoles WHERE nom = '$nom' OR contact = '$contact' OR  adresse = '$adresse' OR email = '$email'";
        $back = $this->connection->query($sql)->fetchAll();
        if (empty($back))
        {
            if (!empty($nom) && !empty($email) && !empty($contact) && !empty($adresse))
            {
                $sql = "INSERT INTO ecoles(nom, email, contact, adresse) VALUES(:nom, :email, : contact, :adresse)";
                $stmt = $this->connection->prepare($sql);
                $stmt->bindValue('nom', $nom);
                $stmt->bindValue('email', $email);
                $stmt->bindValue('contact', $contact);
                $stmt->bindValue('adresse', $adresse);
                /****************************************
                 **** EXECUTE CREATE SCHOOL REQUEST *****
                 ****************************************/
                try
                {
                    if($stmt->execute())
                    {
                        $sql = "SELECT * FROM ecoles where email = '$email' LIMIT 1";
                        $ecole = $this->connection->query($sql)->fetchAll()[0];
                        $id_slug = $this->generateStringId($ecole['nom'], $ecole['id']);
                        $id_ecole = $ecole['id'];
                        $sql_update = "UPDATE ecoles SET id_slug = $id_slug WHERE id = $id_ecole";
                        if ($this->connection->prepare($sql_update)->execute())
                        {
                            return [
                                'success' => true,
                                'response' => $this->connection->query($sql)->fetchAll()[0]
                            ];
                        }
                    }
                    else
                    {
                        return [
                            "success" => false,
                            'message' => "An error occurs"
                        ];
                    }
                }
                catch (HttpException $exception)
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
                    "message" => "Veuillez remplir les champs requis"
                ];
            }
        }
        else
        {
            return [
                "success" => false,
                "message" => "Ces infos existent déjà"
            ];
        }
    }
    /**
     * @param int $id
     * @return mixed|null
     */
    public function school(int $id)
    {
        return $this->getOne('schools', $id);
    }

    /**
     * @param int $id
     * @return array|false|mixed|string
     */
    public function deleteSchool(int $id)
    {
        return $this->deleteOne('schools', $id);
    }

    /**
     * @param $string
     * @param $int
     * @return string
     */
    public function generateStringId($string, $int) {
        $prefix = strtoupper(substr($string, 0, 3));
        return $prefix . $int;
    }

    public function createUniqueId(string $nom, int $id) {
        $prefix = strtoupper(substr($nom, 0, 3));
        $this->connection->beginTransaction();
        while (true) {
            $identifiant = $prefix . $id;
            $sql = "SELECT * FROM ecoles WHERE id_slug = '$identifiant'";
            $result = $this->connection->query($sql)->fetchAll();
            if (empty($result)) {
                $this->connection->commit();
                return $identifiant;
            }
            $id++;
        }
    }


}