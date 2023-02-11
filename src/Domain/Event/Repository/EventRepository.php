<?php

namespace App\Domain\Event\Repository;

use PDO;
use Slim\Exception\HttpException;

final class EventRepository extends \App\Domain\Core\Repository\Repository
{
    public function __construct(PDO $connection)
    {
        parent::__construct($connection);
    }

    /**
     * @return array|false
     */
    public function events()
    {
        return $this->getAll('evenements');
    }

    /**
     * @param int $id
     * @return mixed|null
     */
    public function event(int $id)
    {
        return $this->getOne('evenements', $id);
    }

    /**
     * @param int $id
     * @return array|false|mixed|string
     */
    public function deleteEvent(int $id)
    {
        return $this->deleteOne('evenements', $id);
    }

    /**
     * @param array $event
     * @return array
     */
    public function createEvent(array $event): array
    {
        $titre = htmlspecialchars($event['titre']);
        $description = htmlspecialchars($event['description']);
        $lieu = htmlspecialchars($event['lieu']);
        $date_de_debut = htmlspecialchars($event['date_de_debut']);
        $date_de_fin = htmlspecialchars($event['date_de_fin']);
        $id_ecole = $event['id_ecole'];
        if(strtotime($date_de_debut) >= (time()-(60*60*24)) && strtotime($date_de_fin) >= (time()-(60*60*24)))
        {
            if (strtotime($date_de_fin) >= strtotime($date_de_debut))
            {
                $sql = "INSERT INTO evenements(motif, contenu, lieu, date_debut_evenement, date_fin_evenement, id_ecole) VALUES (:motif, :contenu, :lieu, :date_debut_evenement, :date_fin_evenement, :id_ecole)";
                $stmt = $this->connection->prepare($sql);
                $stmt->bindValue('motif', $titre);
                $stmt->bindValue('contenu', $description);
                $stmt->bindValue('lieu', $lieu);
                $stmt->bindValue('date_debut_evenement', $date_de_debut);
                $stmt->bindValue('date_fin_evenement', $date_de_fin);
                $stmt->bindValue('id_ecole', $id_ecole);
                $sql1 = "SELECT * FROM evenements WHERE id_ecole = $id_ecole AND motif = '$titre'";
                $green = $this->connection->query($sql1)->fetchAll();
                if (empty($green))
                {
                    try
                    {
                        if($stmt->execute())
                        {
                            $sql2 = "SELECT * FROM evenements where id_ecole = $id_ecole AND motif = '$titre' LIMIT 1";
                            $evenement = $this->connection->query($sql2)->fetchAll();
                            return [
                                "success" => true,
                                "response" => $evenement[0]
                            ];
                        }
                        else
                        {
                            return ["success" => false, 'message' => "An error occurs"];
                        }
                    }
                    catch (HttpException $exception)
                    {
                        #$errorMessage = sprintf('%s %s', $statusCode, $response->getReasonPhrase());
                        return ["success" => false, "message" => $exception->getMessage()];
                    }
                }
                else
                {
                    return [
                        "success" => false,
                        'message' => "That slogan had already existed",
                        "Astuce" => "Change slogan Please"];
                }
            }
            else
            {
                return [
                    "success" => false,
                    "message" => "Erreur de concordance des dates"];
            }
        }
        else
        {
            return [
                "success" => false,
                'message' => "La date est obsolete"];
        }
    }

    /**
     * @param int $id_ecole
     * @return array
     */
    public function schoolEvents(int $id_ecole)
    {
        $sql = "SELECT * FROM evenements WHERE id_ecole =  $id_ecole";
        $events = $this->connection->query($sql)->fetchAll();
        if (!empty($events))
        {
            return [
                "success" => true,
                "response" => $events
            ];
        }
        else
        {
            return [
                "success" => false,
                "message" => "Vous n'avez pas de motifs dans la base"
            ];
        }
    }

    /**
     * @param int $id_ecole
     * @return array|false|mixed|string
     */
    public function deleteSchoolEvents(int $id_ecole)
    {
        $sql = "DELETE FROM evenements WHERE id_ecole = $id_ecole";
        $stmt = $this->connection->prepare($sql);
        return $this->exeStatement($stmt, ['success' => true, "message" => "Evenements supprimés"]);
    }


}