<?php

namespace App\Action\School;

use App\Domain\School\Service\CreateSchoolService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class CreateSchoolAction
{
    /**
     * @var CreateSchoolService
     */
    private CreateSchoolService $service;

    /**
     * @param CreateSchoolService $service
     */
    public function __construct(CreateSchoolService $service)
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
        $result = $this->service->addSchool($data);
        //Build HTTP Response
        $response->getBody()->write(json_encode($result));
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }
}