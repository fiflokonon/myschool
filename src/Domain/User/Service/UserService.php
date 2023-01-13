<?php

namespace App\Domain\User\Service;

use App\Domain\User\Repository\UserRepository;

final class UserService
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
     * @return mixed|null
     */
    public function getUser(int $id)
    {
        $user = $this->repository->user($id);
        if ($user == NULL)
         return [
             "success" => true,
             'message' => "Utilisateur inexistant"];
        else
            return $user;
    }
}