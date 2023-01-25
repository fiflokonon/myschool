<?php

namespace App\Action\Demand;

use App\Domain\Demand\Service\CreateDemandService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class CreateDemandAction
{
    /**
     * @var CreateDemandService
     */
    private CreateDemandService $service;

    /**
     * @param CreateDemandService $service
     */
    public function __construct(CreateDemandService $service)
    {
        $this->service = $service;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        array $args
    ): ResponseInterface
    {
        $data = $request->getParsedBody();
        // TODO: Implement __invoke() method.
        $result = $this->service->addDemand($data, $args['id']);
        //Build HTTP Response
        $response->getBody()->write(json_encode($result));
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }
}