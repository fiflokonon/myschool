<?php

namespace App\Action\Demand;

use App\Domain\Demand\Service\SchoolReadMessagesService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class SchoolReadMessagesAction
{
    /**
     * @var SchoolReadMessagesService
     */
    private SchoolReadMessagesService $service;

    /**
     * @param SchoolReadMessagesService $service
     */
    public function __construct(SchoolReadMessagesService $service)
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
        $result = $this->service->getSchoolReadMessages($args['id']);
        //Build HTTP Response
        $response->getBody()->write(json_encode($result));
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }
}