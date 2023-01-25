<?php

namespace App\Action\Demand;

use App\Domain\Demand\Service\ChangeMessageStatutService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class ChangeMessageStatutAction
{
    /**
     * @var ChangeMessageStatutService
     */
    private ChangeMessageStatutService $service;

    /**
     * @param ChangeMessageStatutService $service
     */
    public function __construct(ChangeMessageStatutService $service)
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
    ): ResponseInterface
    {
        // TODO: Implement __invoke() method.
        $result = $this->service->modifyMessageStatut($args['id']);
        //Build HTTP Response
        $response->getBody()->write(json_encode($result));
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }
}