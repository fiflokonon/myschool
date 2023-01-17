<?php

namespace App\Action\School;

use App\Domain\School\Service\DeleteSchoolService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class DeleteSchoolAction
{
    /**
     * @var DeleteSchoolService
     */
    private DeleteSchoolService $service;

    /**
     * @param DeleteSchoolService $service
     */
    public function __construct(DeleteSchoolService $service)
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
        // TODO: Implement __invoke() method.
        $result = $this->service->delSchool($args['id']);
        //Build HTTP Response
        $response->getBody()->write(json_encode($result));
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }
}