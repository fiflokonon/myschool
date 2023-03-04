<?php

namespace App\Action\Punition;

use App\Domain\Punition\Service\DeletePunitionService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class DeletePunitionAction
{
    /**
     * @var DeletePunitionService
     */
    private DeletePunitionService $service;

    public function __construct(DeletePunitionService $service)
    {
        $this->service = $service;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        array $args
    ):ResponseInterface
    {
        // TODO: Implement __invoke() method.
        $result = $this->service->deletePunition($args['id']);
        //Build HTTP Response
        $response->getBody()->write(json_encode($result));
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }
}