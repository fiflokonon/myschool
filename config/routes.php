<?php

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\App;
use App\Action\User\UsersAction;
use App\Action\User\UserAction;

return function (App $app) {
    $app->get('/', function (ServerRequestInterface $request, ResponseInterface $response) {
        $response->getBody()->write('Hello, World!');

        return $response;
    });

    $app->get('/users', UsersAction::class);
    $app->get('/users/{id}', UserAction::class);
};
