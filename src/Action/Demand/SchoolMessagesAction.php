<?php

namespace App\Action\Demand;

use App\Domain\Demand\Service\SchoolMessagesService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class SchoolMessagesAction
{
    /**
     * @var SchoolMessagesService
     */
    private SchoolMessagesService $service;

    /**
     * @param SchoolMessagesService $service
     */
    public function __construct(SchoolMessagesService $service)
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
        $result = $this->service->getSchoolMessages($args['id']);
        //Build HTTP Response
        $response->getBody()->write(json_encode($result));
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }

}