<?php

namespace App\Domain\Note\Service;

use App\Domain\Note\Repository\NoteRepository;

final class CreateNoteService
{
    /**
     * @var NoteRepository
     */
    private NoteRepository $repository;

    /**
     * @param NoteRepository $repository
     */
    public function __construct(NoteRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param int $id_eleve
     * @param int $id_matiere
     * @param array $note
     * @return array|false|mixed|string
     */
    public function addNote(int $id_eleve, int $id_matiere, array $note)
    {
        $note['id_eleve'] = $id_eleve;
        $note['id_matiere'] = $id_matiere;
        return $this->repository->createNote($note);
    }
}