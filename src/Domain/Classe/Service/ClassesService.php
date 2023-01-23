<?php

namespace App\Domain\Classe\Service;

use App\Domain\Classe\Repository\ClassRepository;

final class ClassesService
{
    /**
     * @var ClassRepository
     */
    private ClassRepository $repository;

    /**
     * @param ClassRepository $repository
     */
    public function __construct(ClassRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return array|false
     */
    public function getClasses()
    {
        return $this->repository->classes();
    }
}