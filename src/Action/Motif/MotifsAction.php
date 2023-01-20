<?php

namespace App\Action\Motif;

use App\Domain\Motif\Service\MotifsService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class MotifsAction
{
    /**
     * @var MotifsService
     */
    private MotifsService $service;

    /**
     * @param MotifsService $service
     */
    public function __construct(MotifsService $service)
    {
        $this->service = $service;
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @return ResponseInterface
     */
    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response
    ):ResponseInterface
    {
        // TODO: Implement __invoke() method.
        $result = $this->service->getMotifs();
        //Build HTTP Response
        $response->getBody()->write(json_encode($result));
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }
}