<?php

namespace App\Domain\Motif\Service;

use App\Domain\Motif\Repository\MotifRepository;

final class DeleteSchoolMotifsService
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
     * @return array|false|mixed|string
     */
    public function delSchoolMotifs(int $id_ecole)
    {
        return $this->repository->deleteSchoolMotifs($id_ecole);
    }
}