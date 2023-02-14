<?php

namespace App\Domain\User\Repository;

use App\Domain\Core\Repository\Repository;
use PDO;
use Slim\Exception\HttpException;
use function DI\value;

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
        $id_slug = htmlspecialchars($this->createId());
        $sql = "SELECT * FROM utilisateurs WHERE email = '$email' OR tel = '$tel'";
        $get = $this->connection->query($sql)->fetchAll();
        if (empty($get))
        {
            if (!empty($prenoms) && !empty($nom) && !empty($email) && !empty($tel) && !empty($sexe) && !empty($mot_de_passe) && !empty($id_slug))
            {
                $sql = "INSERT INTO utilisateurs(prenoms, nom, email, tel, sexe, mot_de_passe, id_slug) VALUES (:prenoms, :nom, :email, :tel, :sexe, :mot_de_passe, :id_slug)";
                $stmt = $this->connection->prepare($sql);
                $stmt->bindValue('prenoms', $prenoms);
                $stmt->bindValue('nom', $nom);
                $stmt->bindValue('email', $email);
                $stmt->bindValue('tel', $tel);
                $stmt->bindValue('sexe', $sexe);
                $stmt->bindValue('mot_de_passe', $mot_de_passe);
                $stmt->bindValue('id_slug', $id_slug);
                /****************************************
                 **** EXECUTE REGISTER REQUEST **********
                 ****************************************/
                try
                {
                    if($stmt->execute())
                    {
                        #$id = $this->connection->lastInsertId();
                        $sql = "SELECT * FROM utilisateurs where id_slug = '$id_slug' LIMIT 1 ";
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
                "message" => "Contact ou Email déjà associé à un compte"
            ];
        }
    }

    /**
     * @param array $user
     * @return array
     */
    public function connexion(array $user): array
    {
        if (isset($user['mot_de_passe']) && isset($user['email']) && !empty($user['mot_de_passe']) && !empty($user['email']))
        {
            $email = htmlspecialchars($user['email']);
            $sql = "SELECT * FROM utilisateurs WHERE email= '$email'";
            $utilisateur = $this->connection->query($sql)->fetchAll();

            if($this->checkUserExist($utilisateur))
            {
                if ($this->checkPassword($utilisateur[0], $user))
                {
                    unset($utilisateur[0]['mot_de_passe']);
                    $token = $this->generateToken($utilisateur[0]);
                    return [
                        'success' => true,
                        'user' => $utilisateur[0],
                        'token' => $token
                    ];
                }
                else
                {
                    return [
                        'success' => false,
                        'message' => "Email ou mot de passe incorrect"
                    ];
                }
            }
            else
            {
                return ["success" => false,
                    'message' => "Utilisateur inexistant"
                ];
            }
        }
        else
        {
            return [
                "success" => false,
                "message" => "Email ou mot de passe non fourni"
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

    /**
     * @param string $unId
     * @return bool
     */
    public function checkIdExist(string $unId)
    {
        $sql = "SELECT * FROM utilisateurs WHERE id_slug = '$unId'";
        $rep = $this->connection->query($sql)->fetchAll();
        if ($rep)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function createId()
    {
        $id_slug = $this->generateUniqueId(5);
        while ($this->checkIdExist($id_slug))
        {
            $id_slug = $this->generateUniqueId(5);
        }
        return $id_slug;
    }

    /**
     * @param array $user
     * @return bool
     */
    public function checkUserExist(array $user): bool
    {
        if (!empty($user))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function checkPassword(array $user, array $userLog): bool
    {
        if (password_verify($userLog['mot_de_passe'], $user['mot_de_passe']))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function getMe(string $token)
    {
        $decoded = $this->decodeToken($token);
        if ($decoded)
        {
            $id = $decoded->data->id;
            return $this->user($id);
        }
        else{
            return ["success" => false, "message" => "Unauthorized"];
        }
    }

    /**
     * @param int $id
     * @return array
     */
    public function getUserStudents(int $id)
    {
        $sql = "SELECT eleves.* FROM eleves JOIN parents_eleves ON parents_eleves.id_parent = $id";
        $students = $this->connection->query($sql)->fetchAll();
        if (!empty($students))
        {
            return ["success" => true, "response" => $students];
        }
        else
        {
            return ['success' => false, "message" => "Aucun eleve ne vous est lié"];
        }

    }

    /**
     * @param int $id
     * @return array
     */
    public function getUserSchools(int $id)
    {
        /*
        $sql = "SELECT ecoles.nom
         FROM ecoles
         JOIN classes ON ecoles.id = classes.id_ecole
         JOIN eleves ON eleves.id_classe = classes.id
         JOIN parents_eleves ON parents_eleves.id_parent = $id";*/

        $sql = "SELECT ecoles.nom
         FROM ecoles
         JOIN classes ON ecoles.id = classes.id_ecole
         JOIN eleves ON eleves.id_classe = classes.id
         JOIN parents_eleves ON parents_eleves.id_eleve = eleves.id
         WHERE parents_eleves.id_parent = $id";
        $schools = $this->connection->query($sql)->fetchAll();
        if (!empty($schools))
        {
            return ["success" => true, "response" => $schools];
        }
        else
        {
            return ["success" => false, "message" => "Aucune ecole ne vous est lie"];
        }
    }

    /**
     * @param int $id_user
     * @param int $id_school
     * @return array
     */
    public function getUserStudentsBySchool(int $id_user, int $id_school)
    {
        $sql = "SELECT eleves.* 
                FROM eleves 
                JOIN parents_eleves ON eleves.id = parents_eleves.id_eleve 
                JOIN classes ON eleves.id_classe = classes.id
                JOIN ecoles ON classes.id_ecole = ecoles.id
                WHERE parents_eleves.id_parent = $id_user AND ecoles.id =  $id_school
                ";
        $eleves = $this->connection->query($sql)->fetchAll();
        if (!empty($eleves))
        {
            return ["success" => true, "response" => $eleves];
        }
        else
        {
            return ["success" => false, "message" => "Pas d'enfant dans cette école pour vous"];
        }
    }
}