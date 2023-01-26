<?php

namespace App\Domain\Student\Service;

use App\Domain\Student\Repository\StudentRepository;

final class StudentService
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
     * @param int $id
     * @return mixed|null
     */
    public function getStudent(int $id)
    {
        return $this->repository->student($id);
    }
}