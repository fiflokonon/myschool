<?php

namespace App\Domain\Punition\Service;

use App\Domain\Punition\Repository\PunitionRepository;

class StudentPunitionsByField
{
    private PunitionRepository $repository;

    /**
     * @param PunitionRepository $repository
     */
    public function __construct(PunitionRepository $repository)
    {
        $this->repository = $repository;
    }

    public function punitionsByField(int $id_eleve, int $id_matiere)
    {
        $back = $this->repository->getStudentPunitionsByField($id_eleve, $id_matiere);
        if (!empty($back))
        {
            return ["success" => true, "response" => $back];
        }else
        {
            return ["success" => false, "message" => "Pas de punition dans cette matière"];
        }
    }
}