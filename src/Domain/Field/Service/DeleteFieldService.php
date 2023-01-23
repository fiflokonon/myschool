<?php

namespace App\Domain\Field\Service;

use App\Domain\Field\Repository\FieldRepository;

final class DeleteFieldService
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

    public function delField(int $id)
    {
        return $this->repository->deleteField($id);
    }

}