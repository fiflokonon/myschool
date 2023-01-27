<?php

namespace App\Action\Student;

use App\Domain\Student\Service\ClassStudentsService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class ClassStudentsAction
{
    /**
     * @var ClassStudentsService
     */
    private ClassStudentsService $service;

    /**
     * @param ClassStudentsService $service
     */
    public function __construct(ClassStudentsService $service)
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
        $result = $this->service->getClassStudents($args['id']);
        //Build HTTP Response
        $response->getBody()->write(json_encode($result));
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }
}