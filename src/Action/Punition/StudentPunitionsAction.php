<?php

namespace App\Action\Punition;

use App\Domain\Punition\Service\StudentPunitionsService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class StudentPunitionsAction
{
    /**
     * @var StudentPunitionsService
     */
    private StudentPunitionsService $service;

    public function __construct(StudentPunitionsService $service)
    {
        $this->service = $service;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        array $args
    )
    {
        // TODO: Implement __invoke() method.
        $result = $this->service->getStudentPunitions($args['id']);
        //Build HTTP Request
        $response->getBody()->write(json_encode($result));
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }

}