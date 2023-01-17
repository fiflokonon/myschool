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
                 **** EXECUTE CREATE SCHOOL REQUEST **********
                 ****************************************/
                try
                {
                    if($stmt->execute())
                    {
                        $sql = "SELECT * FROM ecoles where email = '$email' LIMIT 1 ";
                        return [
                            'success' => true,
                            'response' => $this->connection->query($sql)->fetchAll()[0]
                        ];
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
                    $statusCode = $exception->getCode();
                    $errorMessage = sprintf('%s %s', $statusCode, $response->getReasonPhrase());
                    return [
                        "success" => false,
                        "message" => $errorMessage
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
}