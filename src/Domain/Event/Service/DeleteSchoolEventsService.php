<?php

namespace App\Domain\Event\Service;

use App\Domain\Event\Repository\EventRepository;

final class DeleteSchoolEventsService
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
     * @return array|false|mixed|string
     */
    public function delSchoolEvents(int $id_ecole)
    {
        return $this->repository->deleteSchoolEvents($id_ecole);
    }
}