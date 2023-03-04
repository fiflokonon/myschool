<?php

use App\Action\Punition\CreatePunitionAction;
use App\Action\Punition\DeletePunitionAction;
use App\Action\Punition\StudentPunitionsAction;
use App\Action\Punition\StudentPunitionsByFieldAction;
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
use App\Action\User\GetMeAction;


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

use App\Action\Classe\ClasseAction;
use App\Action\Classe\ClassesAction;
use App\Action\Classe\CreateClasseAction;
use App\Action\Classe\DeleteClasseAction;
use App\Action\Classe\DeleteSchoolClassesAction;
use App\Action\Classe\SchoolClassesAction;

use App\Action\Demand\ChangeMessageStatutAction;
use App\Action\Demand\CreateDemandAction;
use App\Action\Demand\DeleteDemandAction;
use App\Action\Demand\DeleteSchoolMessagesAction;
use App\Action\Demand\DelSchoolReadMessagesAction;
use App\Action\Demand\DemandAction;
use App\Action\Demand\DemandsAction;
use App\Action\Demand\ReadMessagesAction;
use App\Action\Demand\SchoolMessagesAction;
use App\Action\Demand\SchoolReadMessagesAction;
use App\Action\Demand\SchoolUnreadMessagesAction;
use App\Action\Demand\UnreadMessagesAction;

use App\Action\Field\CreateFieldAction;
use App\Action\Field\DeleteFieldAction;
use App\Action\Field\DelSchoolFieldsAction;
use App\Action\Field\FieldAction;
use App\Action\Field\FieldsAction;
use App\Action\Field\SchoolFieldsAction;

use App\Action\Note\CreateNoteAction;
use App\Action\Note\StudentNotesAction;
use App\Action\Note\StudentNotesByFieldAction;
use App\Action\Note\DeleteNoteAction;

use App\Action\Student\ClassStudentsAction;
use App\Action\Student\CreateStudentAction;
use App\Action\Student\DeleteStudentAction;
use App\Action\Student\SchoolStudentsAction;
use App\Action\Student\StudentsAction;
use App\Action\Student\StudentAction;
use App\Action\Student\AddLinkAction;
use App\Action\User\UserStudentsAction;
use App\Action\User\UserSchoolsAction;
use App\Action\User\SchoolUserStudentsAction;

return function (App $app) {
    $app->get('/', function (ServerRequestInterface $request, ResponseInterface $response) {
        $response->getBody()->write('Hello, World!');

        return $response;
    });

    /***************************
     *     ROUTES             *
     *************************/

    /** ROUTES NO REQUIRE AUTH **/
    $app->post('/api/login', LoginAction::class);
    $app->post('/api/signup', CreateUserAction::class);
    $app->get('/api/users', UsersAction::class);
    /*** ROUTES REQUIRED AUTH ********/
    $app->group('/api', function (RouteCollectorProxy $app)
    {
        /*** CLASSE-ROUTES***/
        $app->get('/classes', ClassesAction::class);
        $app->get('/classes/{id}', ClasseAction::class);
        $app->delete('/classes/{id}', DeleteClasseAction::class);
        $app->post('/schools/{id}/classes', CreateClasseAction::class);
        $app->get('/schools/{id}/classes', SchoolClassesAction::class);
        $app->delete('/schools/{id}/classes', DeleteSchoolClassesAction::class);

        /*** DEMANDE-ROUTES ***/
        $app->get('/messages', DemandsAction::class);
        $app->get('/messages/{id}', DemandAction::class);
        $app->patch('/messages/{id}', ChangeMessageStatutAction::class);
        $app->delete('/messages/{id}', DeleteDemandAction::class);
        $app->get('/nonread-messages', UnreadMessagesAction::class);
        $app->get('/read-messages', ReadMessagesAction::class);
        $app->get('/schools/{id}/messages', SchoolMessagesAction::class);
        $app->delete('/schools/{id}/messages', DeleteSchoolMessagesAction::class);
        $app->get('/schools/{id}/nonread-messages', SchoolUnreadMessagesAction::class);
        $app->get('/schools/{id}/read-messages', SchoolReadMessagesAction::class);
        $app->delete('/schools/{id}/read-messages', DelSchoolReadMessagesAction::class);
        $app->post('/users/{id_utilisateur}/schools/{id_ecole}/messages', CreateDemandAction::class);

        /*** EVENT-ROUTES ***/
        $app->get('/events', EventsAction::class);
        $app->get('/events/{id}', EventAction::class);
        $app->delete('/events/{id}', DeleteEventAction::class);
        $app->get('/schools/{id}/events', SchoolEventsAction::class);
        $app->post('/schools/{id}/events', CreateEventAction::class);
        $app->delete('/schools/{id}/events', DeleteSchoolEventsAction::class);

        /*** MATIERE-ROUTES ***/
        $app->get('/matieres', FieldsAction::class);
        $app->get('/matieres/{id}', FieldAction::class);
        $app->delete('/matieres/{id}', DeleteFieldAction::class);
        $app->get('/schools/{id}/matieres', SchoolFieldsAction::class);
        $app->post('/schools/{id}/matieres', CreateFieldAction::class);
        $app->delete('/schools/{id}/matieres', DelSchoolFieldsAction::class);

        /*** MOTIF-ROUTES ***/
        $app->get('/motifs', MotifsAction::class);
        $app->get('/motifs/{id}', MotifAction::class);
        $app->delete('/motifs/{id}', DeleteMotifAction::class);
        $app->get('/schools/{id}/motifs', SchoolMotifsAction::class);
        $app->post('/schools/{id}/motifs', CreateMotifAction::class);
        $app->delete('/schools/{id}/motifs', DeleteSchoolMotifsAction::class);

        /*** NOTES-ROUTES ***/
        $app->delete('/notes/{id}', DeleteNoteAction::class);
        $app->get('/students/{id}/notes', StudentNotesAction::class);
        $app->get('/students/{id_eleve}/matieres/{id_matiere}/notes', StudentNotesByFieldAction::class);
        $app->post('/students/{id_eleve}/matieres/{id_matiere}/notes', CreateNoteAction::class);

        /*** SCHOOL-ROUTES ***/
        $app->get('/schools', SchoolsAction::class);
        $app->post('/schools', CreateSchoolAction::class);
        $app->get('/schools/{id}', SchoolAction::class);
        $app->delete('/schools/{id}', DeleteSchoolAction::class);

        /*** ELEVES-ROUTES ***/
        $app->get('/students', StudentsAction::class);
        $app->get('/students/{id}', StudentAction::class);
        $app->delete('/students/{id}', DeleteStudentAction::class);
        $app->get('/classes/{id}/students', ClassStudentsAction::class);
        $app->post('/classes/{id}/students', CreateStudentAction::class);
        $app->get('/schools/{id}/students', SchoolStudentsAction::class);
        $app->put('/users/{id}/link', AddLinkAction::class);

        /*** USER-ROUTES ****/
        $app->get('/users/{id}', UserAction::class);
        $app->delete('/users/{id}', DeleteUserAction::class);
        $app->get('/user-auth', GetMeAction::class);
        $app->get('/users/{id}/students', UserStudentsAction::class);
        $app->get('/users/{id_user}/schools/{id_ecole}/students', SchoolUserStudentsAction::class);
        $app->get('/users/{id}/schools', UserSchoolsAction::class);

        /*** PUNITION ROUTES ****/
        $app->delete('/punitions/{id}', DeletePunitionAction::class);
        $app->get('/students/{id}/punitions', StudentPunitionsAction::class);
        $app->get('/students/{id_eleve}/matieres/{id_matiere}/punitions', StudentPunitionsByFieldAction::class);
        $app->post('/students/{id_eleve}/matieres/{id_matiere}/punitions', CreatePunitionAction::class);

    })->add(LoginMiddleware::class)->add(CorsMiddleware::class);

};
