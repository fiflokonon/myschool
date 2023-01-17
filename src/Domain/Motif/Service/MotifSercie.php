<?php

namespace App\Domain\Motif\Service;

use App\Domain\Motif\Repository\MotifRepository;

final class MotifSercie
{
    /**
     * @var MotifRepository
     */
    private MotifRepository $repository;

    public function __construct(MotifRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param int $id
     * @return mixed|null
     */
    public function getMotif(int $id)
    {
        return $this->repository->motif($id);
    }
}