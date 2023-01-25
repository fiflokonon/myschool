<?php

namespace App\Action\Demand;

use App\Domain\Demand\Service\DeleteSchoolMessagesService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class DeleteSchoolMessagesAction
{
    /**
     * @var DeleteSchoolMessagesService
     */
    private DeleteSchoolMessagesService $service;

    /**
     * @param DeleteSchoolMessagesService $service
     */
    public function __construct(DeleteSchoolMessagesService $service)
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
        $result = $this->service->delSchoolMessages($args['id']);
        //Build HTTP Response
        $response->getBody()->write(json_encode($result));
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }
}