<?php

namespace App\Action\Field;

use App\Domain\Field\Service\CreateFieldService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class CreateFieldAction
{
    /**
     * @var CreateFieldService
     */
    private CreateFieldService $service;

    /**
     * @param CreateFieldService $service
     */
    public function __construct(CreateFieldService $service)
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
        $matiere = $request->getParsedBody();
        $result = $this->service->addField($matiere, $args['id']);
        //Build HTTP Response
        $response->getBody()->write(json_encode($result));
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }
}