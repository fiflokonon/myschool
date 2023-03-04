<?php

namespace App\Domain\Punition\Service;

use App\Domain\Punition\Repository\PunitionRepository;

class DeletePunitionService
{
    /**
     * @var PunitionRepository
     */
    private PunitionRepository $repository;

    /**
     * @param PunitionRepository $repository
     */
    public function __construct(PunitionRepository $repository)
    {
        $this->repository = $repository;
    }

    public function deletePunition(int $id)
    {
        return $this->repository->deletePunition($id);
    }
}