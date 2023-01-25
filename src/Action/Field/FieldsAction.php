<?php

namespace App\Action\Field;

use App\Domain\Field\Repository\FieldRepository;
use App\Domain\Field\Service\FieldService;
use App\Domain\Field\Service\FieldsService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class FieldsAction
{
    /**
     * @var FieldsService
     */
    private FieldsService $service;

    /**
     * @param FieldRepository $repository
     */
    public function __construct(FieldsService $service)
    {
        $this->service = $service;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface
    {
        // TODO: Implement __invoke() method.
        $result = $this->service->getFields();
        //Build HTTP Response
        $response->getBody()->write(json_encode($result));
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }
}