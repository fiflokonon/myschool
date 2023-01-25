<?php

namespace App\Domain\Demand\Service;

use App\Domain\Demand\Repository\DemandRepository;

final class SchoolUnreadMessagesService
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
     * @return array
     */
    public function getSchoolUnreadMessages(int $id_ecole)
    {
        return $this->repository->schoolUnreadMessages($id_ecole);
    }
}