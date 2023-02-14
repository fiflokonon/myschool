<?php

namespace App\Action\User;

use App\Domain\User\Service\SchoolUserStudentsService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class SchoolUserStudentsAction
{
    /**
     * @var SchoolUserStudentsService
     */
    private SchoolUserStudentsService $service;

    /**
     * @param SchoolUserStudentsService $service
     */
    public function __construct(SchoolUserStudentsService $service)
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
        $result = $this->service->schoolUserStudents($args['id_user'], $args['id_ecole']);
        //Build Response
        $response->getBody()->write(json_encode($result));
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }
}