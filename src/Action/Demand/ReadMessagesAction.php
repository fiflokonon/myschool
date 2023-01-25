<?php

namespace App\Action\Demand;

use App\Domain\Demand\Service\ReadMessagesService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class ReadMessagesAction
{
    /**
     * @var ReadMessagesService
     */
    private ReadMessagesService $service;

    /**
     * @param ReadMessagesService $service
     */
    public function __construct(ReadMessagesService $service)
    {
        $this->service = $service;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response
    ):ResponseInterface
    {
        // TODO: Implement __invoke() method.
        $result = $this->service->getReadMessages();
        //Build HTTP Response
        $response->getBody()->write(json_encode($result));
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }

}