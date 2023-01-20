<?php

namespace App\Action\Motif;

use App\Domain\Motif\Service\MotifService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class MotifAction
{
    /**
     * @var MotifService
     */
   private MotifService $service;

    /**
     * @param MotifService $service
     */
   public function __construct(MotifService $service)
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
       $result = $this->service->getMotif($args['id']);

       //Build HTTP Response
       $response->getBody()->write(json_encode($result));
       return $response
           ->withHeader('Content-Type', 'application/json')
           ->withStatus(200);
   }
}