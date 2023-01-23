<?php

namespace App\Domain\Field\Service;

use App\Domain\Field\Repository\FieldRepository;

final class SchoolFieldsService
{
    /**
     * @var FieldRepository
     */
    private FieldRepository $repository;

    /**
     * @param FieldRepository $repository
     */
    public function __construct(FieldRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param int $id_ecole
     * @return array
     */
    public function getSchoolFields(int $id_ecole)
    {
        return $this->repository->schoolMatieres($id_ecole);
    }
}