<?php

namespace App\Domain\User\Service;

use App\Domain\User\Repository\UserRepository;

final class DeleteUserService
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
     * @param int $id
     * @return array|false|mixed|string
     */
    public function deleteUser(int $id)
    {
        return $this->repository->deleteUser($id);
    }
}