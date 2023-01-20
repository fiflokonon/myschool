<?php

namespace App\Action\Motif;

use App\Domain\Motif\Service\DeleteSchoolMotifsService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class DeleteSchoolMotifsAction
{
    /**
     * @var DeleteSchoolMotifsService
     */
    private DeleteSchoolMotifsService $service;

    /**
     * @param DeleteSchoolMotifsService $service
     */
    public function __construct(DeleteSchoolMotifsService $service)
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
        $result = $this->service->delSchoolMotifs($args['id']);
        //Build HTTP Response
        $response->getBody()->write(json_encode($result));
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }
}