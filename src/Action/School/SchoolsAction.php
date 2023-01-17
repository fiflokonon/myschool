<?php

namespace App\Action\School;

use App\Domain\School\Service\SchoolsService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class SchoolsAction
{
    /**
     * @var SchoolsService
     */
    private SchoolsService $service;

    /**
     * @param SchoolsService $service
     */
    public function __construct(SchoolsService $service)
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
    ): ResponseInterface
    {
        //Invoke
        $result = $this->service->getSchools();
        //Build HTTP Response
        $response->getBody()->write(json_encode($result));
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }
}