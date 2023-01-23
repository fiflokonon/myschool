<?php

namespace App\Domain\Field\Service;

use App\Domain\Field\Repository\FieldRepository;

final class CreateFieldService
{
    /**
     * @var FieldRepository
     */
    private FieldRepository $repository;

    public function __construct(FieldRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param array $matiere
     * @param int $id_ecole
     * @return array|false|mixed|string
     */
    public function addField(array $matiere, int $id_ecole)
    {
        $matiere['id_ecole'] = $id_ecole;
        return $this->repository->createMatiere($matiere);
    }
}