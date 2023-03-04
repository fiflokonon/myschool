<?php

namespace App\Domain\Demand\Service;

use App\Domain\Demand\Repository\DemandRepository;

final class DemandsService
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
     * @return array|false
     */
    public function getDemands()
    {
        $messages = $this->repository->demands();
        if (!empty($messages))
        {
            return ["success" => true, "response" => $messages];
        }
        else
        {
            return ["success" => false, "message" => "Pas de message dans la base"];
        }
    }
}