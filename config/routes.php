<?php

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\App;

use App\Action\User\UsersAction;
use App\Action\User\UserAction;
use App\Action\User\DeleteUserAction;
use App\Action\User\CreateUserAction;
use App\Action\User\LoginAction;
use App\Domain\Core\Middleware\CorsMiddleware;
use App\Domain\Core\Middleware\LoginMiddleware;

use App\Action\School\SchoolsAction;
use App\Action\School\SchoolAction;
use App\Action\School\CreateSchoolAction;
use App\Action\School\DeleteSchoolAction;

use App\Action\Motif\MotifAction;
use App\Action\Motif\MotifsAction;
use App\Action\Motif\DeleteMotifAction;
use App\Action\Motif\SchoolMotifsAction;
use App\Action\Motif\DeleteSchoolMotifsAction;

use App\Action\Event\EventsAction;
use App\Action\Event\EventAction;
use App\Action\Event\DeleteEventAction;
use App\Action\Event\SchoolEventsAction;
use App\Action\Event\CreateEventAction;
use App\Action\Event\DeleteSchoolEventsAction;

return function (App $app) {
    $app->get('/', function (ServerRequestInterface $request, ResponseInterface $response) {
        $response->getBody()->write('Hello, World!');

        return $response;
    });

    /***********************************************
     *              ROUTES WITHOUT AUTH            *
     **********************************************/
    $app->post('/login', LoginAction::class);
    $app->post('signup', CreateUserAction::class);


    $app->get('/users', UsersAction::class);
    $app->get('/users/{id}', UserAction::class);
    $app->delete('/users/{id}', DeleteUserAction::class);
    $app->post('/users', CreateUserAction::class);



};
