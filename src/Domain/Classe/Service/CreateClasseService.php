<?php

namespace App\Domain\Classe\Service;

use App\Domain\Classe\Repository\ClassRepository;

final class CreateClasseService
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

    public function addClass(array $classe, int $id_ecole)
    {
        $classe['id_ecole'] = $id_ecole;
        return $this->repository->createClasse($classe);
    }
}