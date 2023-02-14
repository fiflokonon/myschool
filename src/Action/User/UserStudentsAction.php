<?php

namespace App\Action\User;

use App\Domain\User\Service\UserStudentsService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class UserStudentsAction
{
    /**
     * @var UserStudentsService
     */
    private UserStudentsService $service;

    /**
     * @param UserStudentsService $service
     */
    public function __construct(UserStudentsService $service)
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
        $result = $this->service->userStudents($args['id']);
        //Build Response
        $response->getBody()->write(json_encode($result));
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }
}