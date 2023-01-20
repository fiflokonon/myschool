<?php

namespace App\Domain\Motif\Service;

use App\Domain\Motif\Repository\MotifRepository;

final class CreateMotifService
{
    /**
     * @var MotifRepository
     */
    private  MotifRepository $repository;

    /**
     * @param MotifRepository $repository
     */
    public function __construct(MotifRepository $repository)
    {
        $this->repository = $repository;
    }

    public function addMotif(array $motif)
    {
        return $this->repository->createMotif($motif);
    }
}