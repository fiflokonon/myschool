<?php

namespace App\Action\Field;

use App\Domain\Field\Service\SchoolFieldsService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class SchoolFieldsAction
{
    /**
     * @var SchoolFieldsService
     */
    private SchoolFieldsService $service;

    /**
     * @param SchoolFieldsService $service
     */
    public function __construct(SchoolFieldsService $service)
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
        $result = $this->service->getSchoolFields($args['id']);

    }
}