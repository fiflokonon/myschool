<?php

namespace App\Domain\Student\Service;

use App\Domain\Student\Repository\StudentRepository;

final class CreateLinkService
{
    /**
     * @var StudentRepository
     */
    private StudentRepository $repository;

    /**
     * @param StudentRepository $repository
     */
    public function __construct(StudentRepository $repository)
    {
        $this->repository = $repository;
    }

    public function addLink(string $matricule, int $id_user)
    {
        return $this->repository->createLink($matricule, $id_user);
    }
}