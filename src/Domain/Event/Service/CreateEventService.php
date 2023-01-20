<?php

namespace App\Domain\Event\Service;

use App\Domain\Event\Repository\EventRepository;

final class CreateEventService
{
    /**
     * @var EventRepository
     */
    private EventRepository $repository;

    /**
     * @param EventRepository $repository
     */
    public function __construct(EventRepository $repository)
    {
        $this->repository = $repository;
    }

    public function addEvent(array $event)
    {
        return $this->repository->createEvent($event);
    }
}