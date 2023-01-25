<?php

namespace App\Action\Demand;

use App\Domain\Demand\Service\SchoolUnreadMessagesService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class SchoolUnreadMessagesAction
{

    /**
     * @var SchoolUnreadMessagesService
     */
    private SchoolUnreadMessagesService $service;

    public function __construct(SchoolUnreadMessagesService $service)
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
        $result = $this->service->getSchoolUnreadMessages($args['id']);
        //Build HTTP Response
        $response->getBody()->write(json_encode($result));
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }
}