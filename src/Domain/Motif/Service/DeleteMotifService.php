<?php

namespace App\Domain\Motif\Service;

use App\Domain\Motif\Repository\MotifRepository;

final class DeleteMotifService
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
     * @return array|false|mixed|string
     */
    public function delMotif(int $id)
    {
        return $this->repository->deleteMotif($id);
    }
}