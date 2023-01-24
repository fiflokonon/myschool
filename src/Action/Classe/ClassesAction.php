<?php

namespace App\Action\Classe;

use App\Domain\Classe\Service\ClassesService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class ClassesAction
{
    /**
     * @var ClassesService
     */
    private ClassesService $service;

    /**
     * @param ClassesService $service
     */
    public function __construct(ClassesService $service)
    {
        $this->service = $service;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response
    ):ResponseInterface
    {
        // TODO: Implement __invoke() method.
        $result = $this->service->getClasses();
        //Build HTTP Response
        $response->getBody()->write(json_encode($result));
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }
}