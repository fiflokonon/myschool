<?php

namespace App\Action\Event;

use App\Domain\Event\Service\EventsService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class EventsAction
{
    /**
     * @var EventsService
     */
    private EventsService $service;

    /**
     * @param EventsService $service
     */
    public function __construct(EventsService $service)
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
        $result = $this->service->getEvents();
        //Build HTTP Response
        $response->getBody()->write(json_encode($result));
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }
}