<?php

namespace App\Action\Note;

use App\Domain\Note\Service\StudentNotesByFieldService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class StudentNotesByFieldAction
{

    /**
     * @var StudentNotesByFieldService
     */
    private StudentNotesByFieldService $service;

    /**
     * @param StudentNotesByFieldService $service
     */
    public function __construct(StudentNotesByFieldService $service)
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
        // TODO: Implement __invoke() method.
        $result = $this->service->getStudentNotesByField($args['id_eleve'], $args['id_matiere']);
        //Build HTTP Response
        $response->getBody()->write(json_encode($result));
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }
}