<?php

namespace App\Domain\Note\Service;

use App\Domain\Note\Repository\NoteRepository;

final class StudentNotesService
{
    /**
     * @var NoteRepository
     */
    private NoteRepository $repository;

    public function __construct(NoteRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param int $id_eleve
     * @return array
     */
    public function getStudentNotes(int $id_eleve)
    {
        return $this->repository->getAllStudentNotes($id_eleve);
    }
}