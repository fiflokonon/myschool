<?php

namespace App\Domain\Note\Service;

use App\Domain\Note\Repository\NoteRepository;

final class StudentNotesByFieldService
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
     * @return array
     */
    public function getStudentNotesByField(int $id_eleve, int $id_matiere)
    {
        return $this->repository->getStudentNotesByField($id_eleve, $id_matiere);
    }
}