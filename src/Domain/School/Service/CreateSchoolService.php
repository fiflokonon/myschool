<?php

namespace App\Domain\School\Service;

use App\Domain\School\Repository\SchoolRepository;

final class CreateSchoolService
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
     * @param array $data
     * @return array
     */
    public function addSchool(array $data)
    {
        return $this->repository->createSchool($data);
    }
}