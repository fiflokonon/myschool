<?php

namespace App\Domain\Note\Service;

use App\Domain\Note\Repository\NoteRepository;

final class DeleteNoteService
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

    public function delNote(int $id)
    {
        return $this->repository->deleteNote($id);
    }
}