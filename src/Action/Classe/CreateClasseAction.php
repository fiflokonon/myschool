<?php

namespace App\Action\Classe;

use App\Domain\Classe\Service\CreateClasseService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class CreateClasseAction
{
    /**
     * @var CreateClasseService
     */
    private CreateClasseService $service;

    public function __construct(CreateClasseService $service)
    {
        $this->service = $service;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        array $args
    ):ResponseInterface
    {
        //Get Data
        $class = $request->getParsedBody();
        // TODO: Implement __invoke() method.
        $result = $this->service->addClass($class, $args['id']);
        //Build HTTP Response
        $response->getBody()->write(json_encode($result));
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }
}