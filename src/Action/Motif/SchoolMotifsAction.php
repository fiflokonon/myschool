<?php

namespace App\Action\Motif;

use App\Domain\Motif\Service\SchoolMotifsService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class SchoolMotifsAction
{
    /**
     * @var SchoolMotifsService
     */
    private SchoolMotifsService $service;

    /**
     * @param SchoolMotifsService $service
     */
    public function __construct(SchoolMotifsService $service)
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
        $result = $this->service->getSchoolMotifs($args['id']);

        //Build HTTP Response
        $response->getBody()->write(json_encode($result));
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }
}