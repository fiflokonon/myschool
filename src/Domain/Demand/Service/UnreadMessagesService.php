<?php

namespace App\Domain\Demand\Service;

use App\Domain\Demand\Repository\DemandRepository;

final class UnreadMessagesService
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

    public function getUnreadMessages()
    {
        return $this->repository->unreadMessages();
    }
}