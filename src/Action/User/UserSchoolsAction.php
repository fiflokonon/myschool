<?php

namespace App\Action\User;

use App\Domain\User\Repository\UserRepository;
use App\Domain\User\Service\UserSchoolsService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class UserSchoolsAction
{
    /**
     * @var UserSchoolsService
     */
    private UserSchoolsService $service;

    /**
     * @param UserSchoolsService $service
     */
    public function __construct(UserSchoolsService $service)
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
        $result = $this->service->userSchools($args['id']);
        //Build Response
        $response->getBody()->write(json_encode($result));
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }
}