<?php

namespace App\Domain\School\Service;

use App\Domain\School\Repository\SchoolRepository;

final class SchoolService
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
     * @param int $id
     * @return mixed|null
     */
    public function getSchool(int $id)
    {
        $back = $this->repository->school($id);
        if (isset($back) && is_null($back))
        {
            return ['success' => false, "message" => "Cette école n'existe pas"];
        }
        else
        {
            return $back;
        }
    }
}