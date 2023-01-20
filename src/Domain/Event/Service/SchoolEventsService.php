<?php

namespace App\Domain\Event\Service;

use App\Domain\Event\Repository\EventRepository;

final class SchoolEventsService
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

    /**
     * @param int $id_ecole
     * @return array
     */
    public function getSchoolEvents(int $id_ecole)
    {
        return $this->repository->schoolEvents($id_ecole);
    }
}