<?php

namespace App\Domain\Punition\Service;

use App\Domain\Punition\Repository\PunitionRepository;

class CreatePunitionService
{
    /**
     * @var PunitionRepository
     */
    private PunitionRepository $repository;

    /**
     * @param PunitionRepository $repository
     */
    public function __construct(PunitionRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param int $id_eleve
     * @param int $id_matiere
     * @param array $punition
     * @return array|false|mixed|string
     */
    public function addPunition(int $id_eleve, int $id_matiere, array $punition)
    {
        $punition['id_eleve'] = $id_eleve;
        $punition['id_matiere'] = $id_matiere;
        return $this->repository->createPunition($punition);
    }
}