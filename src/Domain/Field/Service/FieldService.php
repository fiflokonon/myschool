<?php

namespace App\Domain\Field\Service;

use App\Domain\Field\Repository\FieldRepository;

final class FieldService
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
    public function getField(int $id)
    {
        return $this->repository->matiere($id);
    }
}