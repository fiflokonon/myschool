<?php

namespace App\Domain\School\Service;

use App\Domain\School\Repository\SchoolRepository;

final class SchoolsService
{
    /**
     * @var SchoolRepository
     */
    private SchoolRepository $repository;

    /**
     * @param SchoolRepository $repository
     */
    public function __construct(SchoolRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return array|false
     */
    public function getSchools()
    {
        return $this->repository->schools();
    }
}