<?php

namespace App\Action\Field;

use App\Domain\Field\Service\DelSchoolFieldsService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class DelSchoolFieldsAction
{
    /**
     * @var DelSchoolFieldsService
     */
    private DelSchoolFieldsService $service;

    public function __construct(DelSchoolFieldsService $service)
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
        $result = $this->service->delSchoolFields($args['id']);
        //Build HTTP Response
        $response->getBody()->write(json_encode($result));
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }
}