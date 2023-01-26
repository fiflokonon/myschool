<?php

namespace App\Domain\Student\Service;

use App\Domain\Student\Repository\StudentRepository;

final class CreateStudentService
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

    public function addStudent(int $id_classe, array $student)
    {
        $student['id_classe'] =  $id_classe;
        return $this->repository->createStudent($student);
    }
}