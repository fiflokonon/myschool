<?php

namespace App\Domain\User\Service;

use App\Domain\User\Repository\UserRepository;

final class SchoolUserStudentsService
{
    /**
     * @var UserRepository
     */
    private UserRepository $repository;

    /**
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param int $id_user
     * @param int $id_ecole
     * @return void
     */
    public function schoolUserStudents(int $id_user, int $id_ecole)
    {
        $this->repository->getUserStudentsBySchool($id_user, $id_ecole);
    }
}