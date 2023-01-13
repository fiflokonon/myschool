<?php

namespace App\Domain\User\Service;

use App\Domain\User\Repository\UserRepository;

final class UsersService
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
     * @return array|false
     */
    public function getUsers()
    {
        $users = $this->repository->listUsers();
        if (empty($users))
            return [
                "success" => true,
                'message' => "Aucun utilisateur dans la base"];
        else
            return $users;
    }
}