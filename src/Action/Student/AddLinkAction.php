<?php

namespace App\Action\Student;

use App\Domain\Student\Service\CreateLinkService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class AddLinkAction
{
    /**
     * @var CreateLinkService
     */
    private CreateLinkService $service;

    public function __construct(CreateLinkService $service)
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
    ): ResponseInterface
    {
        $data = $request->getParsedBody();
        // TODO: Implement __invoke() method.
        $result = $this->service->addLink($data['matricule'], $args['id']);
        //Build HTTP Response
        $response->getBody()->write(json_encode($result));
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }
}