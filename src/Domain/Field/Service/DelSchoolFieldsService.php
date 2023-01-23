<?php

namespace App\Domain\Field\Service;

use App\Domain\Field\Repository\FieldRepository;

final class DelSchoolFieldsService
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
     * @return array|false|mixed|string
     */
    public function delSchoolFields(int $id_ecole)
    {
        return $this->repository->deleteSchoolMatieres($id_ecole);
    }
}