<?php

namespace App\Domain\Motif\Service;

use App\Domain\Motif\Repository\MotifRepository;

final class MotifsService
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
     * @return array|false
     */
    public function getMotifs()
    {
        return $this->repository->motifs();
    }
}