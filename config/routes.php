<?php

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\App;
use App\Action\User\UsersAction;
use App\Action\User\UserAction;
use App\Action\User\DeleteUserAction;
use App\Action\User\CreateUserAction;
use App\Action\User\LoginAction;

return function (App $app) {
    $app->get('/', function (ServerRequestInterface $request, ResponseInterface $response) {
        $response->getBody()->write('Hello, World!');

        return $response;
    });

    $app->post('/login', LoginAction::class);

    $app->get('/users', UsersAction::class);
    $app->get('/users/{id}', UserAction::class);
    $app->delete('/users/{id}', DeleteUserAction::class);
    $app->post('/users', CreateUserAction::class);
};
