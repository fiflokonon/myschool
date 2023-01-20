<?php

namespace App\Domain\Motif\Service;

use App\Domain\Motif\Repository\MotifRepository;

final class SchoolMotifsService
{
    /**
     * @var MotifRepository
     */
    private MotifRepository $repository;

    /**
     * @param MotifRepository $repository
     */
    public function __construct(MotifRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param int $id_ecole
     * @return array
     */
    public function getSchoolMotifs(int $id_ecole)
    {
        return $this->repository->schoolMotifs($id_ecole);
    }
}