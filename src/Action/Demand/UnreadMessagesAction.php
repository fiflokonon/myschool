<?php

namespace App\Action\Demand;

use App\Domain\Demand\Service\UnreadMessagesService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class UnreadMessagesAction
{
    /**
     * @var UnreadMessagesService
     */
    private UnreadMessagesService $service;

    /**
     * @param UnreadMessagesService $service
     */
    public function __construct(UnreadMessagesService $service)
    {
        $this->service = $service;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response
    ):ResponseInterface
    {
        // TODO: Implement __invoke() method.
        $result = $this->service->getUnreadMessages();
        //Build HTTP Response
        $response->getBody()->write(json_encode($result));
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }

}