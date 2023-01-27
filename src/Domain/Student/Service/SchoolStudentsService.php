<?php

namespace App\Domain\Student\Service;

use App\Domain\Student\Repository\StudentRepository;

final class SchoolStudentsService
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
     * @param int $id_ecole
     * @return array
     */
    public function getSchoolStudents(int $id_ecole)
    {
        return $this->repository->studentsBySchool($id_ecole);
    }
}