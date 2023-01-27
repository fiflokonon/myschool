<?php

namespace App\Action\Student;

use App\Domain\Student\Service\StudentsService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class StudentsAction
{
    /**
     * @var StudentsService
     */
    private StudentsService $service;

    /**
     * @param StudentsService $service
     */
    public function __construct(StudentsService $service)
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
    ):ResponseInterface
    {
        // TODO: Implement __invoke() method.
        $result = $this->service->getStudents();
        //Build HTTP Response
        $response->getBody()->write(json_encode($result));
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }
}