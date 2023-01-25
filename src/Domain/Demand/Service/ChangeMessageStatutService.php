<?php

namespace App\Domain\Demand\Service;

use App\Domain\Demand\Repository\DemandRepository;

final class ChangeMessageStatutService
{
    /**
     * @var DemandRepository
     */
    private DemandRepository $repository;

    /**
     * @param DemandRepository $repository
     */
    public function __construct(DemandRepository $repository)
    {
        $this->repository = $repository;
    }

    public function modifyMessageStatut(int $id)
    {
        return $this->repository->changeDemandStatus($id);
    }

}