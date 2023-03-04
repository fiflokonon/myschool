<?php

namespace App\Action\Punition;

use App\Domain\Punition\Service\CreatePunitionService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class CreatePunitionAction
{
    /**
     * @var CreatePunitionService
     */
    private CreatePunitionService $service;

    public function __construct(CreatePunitionService $service)
    {
        $this->service = $service;
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param array $args
     * @return ResponseInterface
     */
    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        array $args
    ):ResponseInterface
    {
        // TODO: Implement __invoke() method.
        $data = $request->getParsedBody();
        $result = $this->service->addPunition($args['id_eleve'], $args['id_matiere'], $data);
        //Build HTTP Response
        $response->getBody()->write(json_encode($result));
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }

}