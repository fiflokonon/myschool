<?php

namespace App\Action\Punition;

use App\Domain\Punition\Service\StudentPunitionsByField;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class StudentPunitionsByFieldAction
{
    /**
     * @var StudentPunitionsByField
     */
    private StudentPunitionsByField $service;

    /**
     * @param StudentPunitionsByField $service
     */
    public function __construct(StudentPunitionsByField $service)
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
        $result = $this->service->punitionsByField($args['id_eleve'], $args['id_matiere']);
        //Build HTTP Respponse
        $response->getBody()->write(json_encode($result));
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }

}