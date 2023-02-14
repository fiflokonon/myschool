<?php

namespace App\Domain\User\Service;

use App\Domain\User\Repository\UserRepository;

final class UserSchoolsService
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
     * @return array
     */
    public function userSchools(int $id_user)
    {
        return $this->repository->getUserSchools($id_user);
    }

}