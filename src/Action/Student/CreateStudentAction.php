<?php

namespace App\Action\Student;

use App\Domain\Student\Service\CreateStudentService;
use Nyholm\Psr7\ServerRequest;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class CreateStudentAction
{
    /**
     * @var CreateStudentService
     */
    private CreateStudentService $service;

    /**
     * @param CreateStudentService $service
     */
    public function __construct(CreateStudentService $service)
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
        //Get Data
        $data = $request->getParsedBody();
        // TODO: Implement __invoke() method.
        $result = $this->service->addStudent($args['id'], $data);
        //Build HTTP Response
        $response->getBody()->write(json_encode($result));
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }
}