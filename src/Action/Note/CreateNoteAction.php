<?php

namespace App\Action\Note;

use App\Domain\Note\Repository\NoteRepository;
use App\Domain\Note\Service\CreateNoteService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class CreateNoteAction
{
    /**
     * @var CreateNoteService
     */
    private CreateNoteService $service;

    public function __construct(CreateNoteService $service)
    {
        $this->service = $service;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        array $args
    ):ResponseInterface
    {
        //Get Note Data
        $data = $request->getParsedBody();
        // TODO: Implement __invoke() method.
        $result = $this->service->addNote($args['id_eleve'], $args['id_matiere'], $data);
        //Build HTTP Response
        $response->getBody()->write(json_encode($result));
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }
}