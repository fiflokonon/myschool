<?php

namespace App\Domain\Classe\Service;

use App\Domain\Classe\Repository\ClassRepository;

final class SchoolClassesService
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
     * @param int $id_ecole
     * @return array
     */
    public function getSchoolClasses(int $id_ecole)
    {
        return $this->repository->schoolClasses($id_ecole);
    }
}