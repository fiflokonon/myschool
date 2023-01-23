<?php

namespace App\Domain\Field\Service;

use App\Domain\Field\Repository\FieldRepository;

final class FieldsService
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
     * @return array|false
     */
    public function getFields()
    {
        return $this->repository->matieres();
    }
}