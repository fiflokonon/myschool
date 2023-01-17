<?php

namespace App\Action\School;



use App\Domain\School\Service\SchoolService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class SchoolAction
{
    /**
     * @var SchoolService
     */
    private SchoolService $service;

    /**
     * @param SchoolService $service
     */
    public function __construct(SchoolService $service)
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
    ): ResponseInterface
    {
        //Invoke
        $result = $this->service->getSchool($args['id']);
        //Build HTTP Response
        $response->getBody()->write(json_encode($result));
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }
}