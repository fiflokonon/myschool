<?php

namespace App\Domain\User\Service;

use App\Domain\User\Repository\UserRepository;

final class CreateUserService
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
     * @param array $data
     * @return array
     */
    public function signup(array $data)
    {
        return $this->repository->inscription($data);
    }
}