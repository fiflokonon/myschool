<?php

namespace App\Domain\Demand\Service;

use App\Domain\Demand\Repository\DemandRepository;

final class DemandService
{
    /**
     * @var DemandRepository
     */
    private DemandRepository $repository;

    public function __construct(DemandRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param int $id
     * @return mixed|null
     */
    public function getDemand(int $id)
    {
        return $this->repository->demand($id);
    }
}