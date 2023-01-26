<?php

namespace App\Domain\Student\Service;

use App\Domain\Student\Repository\StudentRepository;

final class ClassStudents
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

    /**
     * @param int $id_classe
     * @return array
     */
    public function getClassStudents(int $id_classe)
    {
        return $this->repository->classStudents($id_classe);
    }
}