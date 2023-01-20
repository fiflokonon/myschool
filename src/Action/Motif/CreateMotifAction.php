<?php

namespace App\Action\Motif;

use App\Domain\Motif\Service\CreateMotifService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class CreateMotifAction
{
    /**
     * @var CreateMotifService
     */
    private CreateMotifService $service;

    /**
     * @param CreateMotifService $service
     */
    public function __construct(CreateMotifService $service)
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
        //Get Data
        $data = $request->getParsedBody();
        $data['id_ecole'] = $args['id'];
        // TODO: Implement __invoke() method.
        $result = $this->service->addMotif($data);
        //Build HTTP Response
        $response->getBody()->write(json_encode($result));
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }
}