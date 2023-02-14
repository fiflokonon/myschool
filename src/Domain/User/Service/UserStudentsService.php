<?php

namespace App\Domain\User\Service;

use App\Domain\User\Repository\UserRepository;

final class UserStudentsService
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

    public function userStudents(int $id)
    {
        return $this->repository->getUserStudents($id);
    }
}