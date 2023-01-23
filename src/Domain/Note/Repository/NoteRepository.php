<?php

namespace App\Domain\Note\Repository;

use PDO;
use Slim\Exception\HttpException;

class NoteRepository extends \App\Domain\Core\Repository\Repository
{
    public function __construct(PDO $connection)
    {
        parent::__construct($connection);
    }

    /**
     * @param int $id
     * @return array
     */
    public function getAllStudentNotes(int $id)
    {
        $sql = "SELECT * FROM notes WHERE id_eleve = $id";
        try {
            $notes = $this->connection->query($sql)->fetchAll();
            return[
                "success" => true,
                "response" => $notes
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

    public function getStudentNotesByField(int $id, int $id_field)
    {
        $sql_matiere = "SELECT * FROM matieres WHERE id = $id_field LIMIT 1";
        $sql_notes = "SELECT * FROM notes WHERE id_eleve = $id AND id_matiere = $id_field";
        try {
            $notes = $this->connection->query($sql_notes)->fetchAll();
            $matiere = $this->connection->query($sql_matiere)->fetchAll()[0];
            return [
                "success" => true,
                "response" => [
                    "matiere" => $matiere['matiere'],
                    "notes" => $notes
                ]
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

    public function createNote(array $note)
    {
        $_note = htmlspecialchars($note['note']);
        $id_eleve = htmlspecialchars($note['id_eleve']);
        $id_matiere = htmlspecialchars($note['id_matiere']);
        $type = htmlspecialchars($note['type']);
        $sql = "INSERT INTO notes(id_eleve, note, type, id_matiere) VALUES (:id_eleve, :note, :type, :id_matiere)";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue('id_eleve', $id_eleve);
        $stmt->bindValue('note', $_note);
        $stmt->bindValue('type', $type);
        $stmt->bindValue('id_matiere', $id_matiere);
        return $this->exeStatement($stmt, ['success' => true, "message" => "Note ajoutée"]);
    }
}