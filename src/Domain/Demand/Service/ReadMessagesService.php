<?php

namespace App\Domain\Demand\Service;

use App\Domain\Demand\Repository\DemandRepository;

final class ReadMessagesService
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
     * @return array
     */
    public function getReadMessages()
    {
        return $this->repository->readMessages();
    }
}