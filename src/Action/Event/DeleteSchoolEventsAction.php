<?php

namespace App\Action\Event;

use App\Domain\Event\Service\DeleteSchoolEventsService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class DeleteSchoolEventsAction
{
    /**
     * @var DeleteSchoolEventsService
     */
    private DeleteSchoolEventsService $service;

    /**
     * @param DeleteSchoolEventsService $service
     */
    public function __construct(DeleteSchoolEventsService $service)
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
        $result = $this->service->delSchoolEvents($args['id']);

        //Build HTTP Response
        $response->getBody()->write(json_encode($result));
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }
}