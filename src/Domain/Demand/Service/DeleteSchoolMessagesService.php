<?php

namespace App\Domain\Demand\Service;

use App\Domain\Demand\Repository\DemandRepository;

final class DeleteSchoolMessagesService
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
     * @param int $id_ecole
     * @return array|false|mixed|string
     */
    public function delSchoolMessages(int $id_ecole)
    {
        return $this->repository->deleteSchoolDemands($id_ecole);
    }
}