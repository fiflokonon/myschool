<?php

namespace App\Domain\Punition\Service;

use App\Domain\Punition\Repository\PunitionRepository;

class StudentPunitionsService
{
    /**
     * @var PunitionRepository
     */
    private PunitionRepository $repository;

    public function __construct(PunitionRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getStudentPunitions(int $id)
    {
        $back = $this->repository->getAllStudentPunitions($id);
        if (!empty($back))
        {
            return ["success" => true, "response" => $back];
        }else
        {
            return ["success" => false, "message" => "Pas de punitions"];
        }
    }
}