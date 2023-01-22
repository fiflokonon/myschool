<?php

namespace App\Domain\Demand\Service;

use App\Domain\Demand\Repository\DemandRepository;

final class CreateDemandService
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

    /**
     * @param array $demand
     * @param int $id_utilisateur
     * @return array|false|mixed|string
     */
    public function addDemand(array $demand, int $id_utilisateur)
    {
        $demand['id_utilisateur'] = $id_utilisateur;
        return $this->repository->createDemand($demand);
    }
}