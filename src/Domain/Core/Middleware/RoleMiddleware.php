<?php

namespace App\Domain\Core\Middleware;

use App\Domain\Core\Repository\Repository;
use App\Domain\User\Repository\UserRepository;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use function DI\string;

class RoleMiddleware
{
    /**
     * @var UserRepository
     */
    private UserRepository $repository;

    public function __construct($repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param ServerRequestInterface $request
     * @param RequestHandlerInterface $handler
     * @return void
     */
    public function __invoke(
        ServerRequestInterface $request,
        RequestHandlerInterface $handler,
        string $role
    )
    {
        //Get Token
        if (isset($_SERVER['HTTP_AUTHORIZATION'])) {
            $authHeader = $_SERVER['HTTP_AUTHORIZATION'];
            $arr = explode(" ", (string($authHeader)));
            if ($arr[0] = "Bearer") {
                $jwt = $arr[1];
                die(var_dump($this->repository->decodeToken($jwt)));
                }
            }
    }

    public function checkRole(array $user, string $role)
    {
        if (isset($user['role']) && $user['role'] === $role) {
            return true;
        }else{

            return false;
        }
    }
}
