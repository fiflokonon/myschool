<?php

namespace App\Domain\Motif\Repository;

use PDO;
use Slim\Exception\HttpException;

final class MotifRepository extends \App\Domain\Core\Repository\Repository
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
    public function motifs()
    {
        return $this->getAll('motifs');
    }

    /**
     * @param int $id
     * @return mixed|null
     */
    public function motif(int $id)
    {
        return $this->getOne('motifs', $id);
    }

    /**
     * @param int $id
     * @return array|false|mixed|string
     */
    public function deleteMotif(int $id)
    {
        return $this->deleteOne('motifs', $id);
    }

    /**
     * @param array $motif
     * @return array|void
     */
    public function createMotif(array $motif)
    {
        $motif_nom = htmlspecialchars($motif['motif']);
        $montant_motif = htmlspecialchars($motif['montant_motif']);
        $id_ecole = htmlspecialchars($motif['id_ecole']);
        $sql = "SELECT * FROM motifs WHERE id_ecole = $id_ecole AND motif = '$motif_nom'";
        $get = $this->connection->query($sql);
        if (empty($get))
        {
            if (!empty($motif_nom) && !empty($montant_motif) && !empty($id_ecole))
            {
                $sql = "INSERT INTO motifs(motif, montant_motif, id_ecole) VALUES (:motif, :montant_motif, :id_ecole)";
                $stmt = $this->connection->prepare($sql);
                $stmt->bindValue('motif', $motif_nom);
                $stmt->bindValue('montant_motif', $montant_motif);
                $stmt->bindValue('id_ecole', $id_ecole);
                try {
                    if ($stmt->execute())
                    {
                        $sql_get = "SELECT * FROM motifs WHERE id_ecole = $id_ecole AND motif = '$motif_nom' LIMIT 1 ";
                        $new_motif = $this->connection->query($sql_get)->fetchAll();
                        return [
                          "success" => true,
                          "response" => $new_motif[0]
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
                  "message" => "Remplissez les champs requis"
                ];
            }
        }
        else
        {
            return [
                "success" => false,
                "message" => "Votre ecole dispose déjà d'un motif du meme nom"
            ];
        }
    }

    /**
     * @param int $id_ecole
     * @return array
     */
    public function schoolMotifs(int $id_ecole): array
    {
        $sql = "SELECT * FROM motifs WHERE id_ecole = '$id_ecole'";
        $motifs = $this->connection->query($sql)->fetchAll();
        if (!empty($motifs))
        {
            return [
                "success" => true,
                "response" => $motifs
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
    public function deleteSchoolMotifs(int $id_ecole)
    {
        $sql = "DELETE * FROM motifs WHERE id_ecole = $id_ecole";
        $stmt = $this->connection->prepare($sql);
        return $this->exeStatement($stmt, ["success" => true, "message" => "Motifs supprimés"]);
    }
}