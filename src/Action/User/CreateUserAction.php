<?php

namespace App\Action\User;

use App\Domain\User\Service\CreateUserService;
use MongoDB\Driver\Server;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class CreateUserAction
{
    /**
     * @var CreateUserService
     */
    private CreateUserService $service;

    /**
     * @param CreateUserService $service
     */
    public function __construct(CreateUserService $service)
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
        //Get Data
        $data = $request->getParsedBody();
        //Invoke
        $result = $this->service->signup($data);

        //Build HTTP Response
        $response->getBody()->write(json_encode($result));
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }
}