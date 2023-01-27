<?php

namespace App\Action\Note;

use App\Domain\Note\Service\DeleteNoteService;
use Grpc\Server;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class DeleteNoteAction
{
    /**
     * @var DeleteNoteService
     */
    private DeleteNoteService $service;

    /**
     * @param DeleteNoteService $service
     */
    public function __construct(DeleteNoteService $service)
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
        $result = $this->service->delNote($args['id']);
        //Build HTTP Response
        $response->getBody()->write(json_encode($result));
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }
}