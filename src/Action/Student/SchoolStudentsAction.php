<?php

namespace App\Action\Student;

use App\Domain\Student\Service\SchoolStudentsService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class SchoolStudentsAction
{
    /**
     * @var SchoolStudentsService
     */
    private SchoolStudentsService $service;

    /**
     * @param SchoolStudentsService $service
     */
    public function __construct(SchoolStudentsService $service)
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
        $result = $this->service->getSchoolStudents($args['id']);
        //Build HTTP Response
        $response->getBody()->write(json_encode($result));
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }
}