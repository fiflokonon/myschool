<?php

namespace App\Domain\Classe\Service;

use App\Domain\Classe\Repository\ClassRepository;

final class DeleteSchoolClassesService
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
     * @return array|false|mixed|string
     */
    public function delSchoolClasses(int $id_ecole)
    {
        return $this->repository->deleteSchoolClasses($id_ecole);
    }
}
