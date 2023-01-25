<?php

namespace App\Domain\Demand\Service;

use App\Domain\Demand\Repository\DemandRepository;

final class DelSchoolReadMessagesService
{
    /**
     * @var DemandRepository
     */
    private DemandRepository $repository;

    public function __construct(DemandRepository $repository)
    {
        $this->repository = $repository;
    }

    public function delSchoolReadMessages(int $id_ecole)
    {
        return $this->repository->deleteSchoolReadMessages($id_ecole);
    }

}