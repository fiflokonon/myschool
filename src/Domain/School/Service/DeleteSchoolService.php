<?php

namespace App\Domain\School\Service;

use App\Domain\School\Repository\SchoolRepository;

final class DeleteSchoolService
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

    /***
     * @param int $id
     * @return array|false|mixed|string
     */
    public function delSchool(int $id)
    {
        return $this->repository->deleteSchool($id);
    }
}