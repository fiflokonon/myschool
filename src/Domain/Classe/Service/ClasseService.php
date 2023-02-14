<?php

namespace App\Domain\Classe\Service;

use App\Domain\Classe\Repository\ClassRepository;

final class ClasseService
{
    /**
     * @var ClassRepository
     */
    private ClassRepository $repository;

    /**
     * @param ClassRepository $repository
     */
    public function __construct(ClassRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param int $id
     * @return mixed|null
     */
    public function getClasse(int $id)
    {
        $back = $this->repository->classe($id);
        if (empty($back) && is_null($back))
        {
            return ['success' => false, "message" => "Cette classe n'existe pas"];
        }
        else
        {
            return $back;
        }
    }
}