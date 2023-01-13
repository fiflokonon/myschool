<?php

namespace App\Domain\User\Repository;

use App\Domain\Core\Repository\Repository;
use PDO;

class UserRepository extends Repository
{
    /**
     * @param PDO $connection
     */
    public function __construct(PDO $connection)
    {
        parent::__construct($connection);
    }

    /**
     * @param array $user
     * @return array
     */
    public function inscription(array $user)
    {
        $prenoms = htmlspecialchars($user['prenoms']);
        $nom = htmlspecialchars($user['nom']);
        $email = htmlspecialchars($user['email']);
        $tel = htmlspecialchars($user['tel']);
        $sexe = htmlspecialchars($user['sexe']);
        $mot_de_passe = password_hash(htmlspecialchars($user['mot_de_passe']), PASSWORD_DEFAULT);
        $sql = "SELECT * FROM utilisateurs WHERE email = '$email' OR tel = '$tel'";
        $get = $this->connection->query($sql)->fetchAll();
        if (empty($get))
        {
            if (!empty($prenoms) && !empty($nom) && !empty($email) && !empty($tel) && !empty($sexe) && !empty($mot_de_passe))
            {
                $sql = "INSERT INTO utilisateurs(prenoms, nom, email, tel, sexe, mot_de_passe) VALUES (:prenoms, :nom, :email, :tel, :sexe, :mot_de_passe)";
                $stmt = $this->connection->prepare($sql);
                $stmt->bindValue('prenoms', $prenoms);
                $stmt->bindValue('nom', $nom);
                $stmt->bindValue('email', $email);
                $stmt->bindValue('tel', $tel);
                $stmt->bindValue('sexe', $sexe);
                $stmt->bindValue('mot_de_passe', $mot_de_passe);
                /****************************************
                 **** EXECUTE REGISTER REQUEST **********
                 ****************************************/
                try
                {
                    if($stmt->execute())
                    {
                        $id = $this->connection->lastInsertId();
                        $sql = "SELECT * FROM utilisateurs where id=$id LIMIT 1 ";
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
                        "message" => $errorMessage];
                }
            }
            else
            {
                return [
                    "success" => false,
                    "message" => "Une variable est vide"
                ];
            }
        }
        else
        {
            return [
                "success" => false,
                "message" => "Contact ou Email déjà associé à un compte"
            ];
        }

    }


    /**
     * @return array|false
     */
    public function listUsers()
    {
        return $this->getAll('utilisateurs');
    }

    /**
     * @param int $id
     * @return mixed|null
     */
    public function user(int $id)
    {
        return $this->getOne('utilisateurs', $id);
    }

    /**
     * @param int $id
     * @return array|false|mixed|string
     */
    public function deleteUser(int $id)
    {
        return $this->deleteOne('utilisateurs', $id);
    }
}