<?php

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\App;
use Slim\Routing\RouteCollectorProxy;
use App\Domain\Core\Middleware\CorsMiddleware;
use App\Domain\Core\Middleware\LoginMiddleware;

use App\Action\User\UsersAction;
use App\Action\User\UserAction;
use App\Action\User\DeleteUserAction;
use App\Action\User\CreateUserAction;
use App\Action\User\LoginAction;


use App\Action\School\SchoolsAction;
use App\Action\School\SchoolAction;
use App\Action\School\CreateSchoolAction;
use App\Action\School\DeleteSchoolAction;

use App\Action\Motif\MotifAction;
use App\Action\Motif\MotifsAction;
use App\Action\Motif\DeleteMotifAction;
use App\Action\Motif\SchoolMotifsAction;
use App\Action\Motif\DeleteSchoolMotifsAction;
use App\Action\Motif\CreateMotifAction;

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

    /***************************
     *     ROUTES             *
     *************************/

    /** ROUTES NO REQUIRE AUTH **/
    $app->post('/login', LoginAction::class);
    $app->post('signup', CreateUserAction::class);

    /*** ROUTES REQUIRED AUTH ********/
    $app->group('/api', function (RouteCollectorProxy $app)
    {
        $app->get('/users', UsersAction::class);
        $app->get('/users/{id}', UserAction::class);
        $app->delete('/users/{id}', DeleteUserAction::class);
        #$app->post('/users', CreateUserAction::class);

        $app->get('/schools', SchoolsAction::class);
        $app->get('/schools/{id}', SchoolAction::class);
        $app->post('/schools', CreateSchoolAction::class);
        $app->delete('/schools/{id}', DeleteSchoolAction::class);

        $app->get('/motifs', MotifsAction::class);
        $app->get('/motifs/{id}', MotifAction::class);
        $app->get('/schools/{id}/motifs', SchoolMotifsAction::class);
        $app->post('/schools/{id}/motifs', CreateMotifAction::class);
        $app->delete('/motifs/{id}', DeleteMotifAction::class);

    });



};
