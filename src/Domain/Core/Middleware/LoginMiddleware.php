<?php

namespace App\Domain\Core\Middleware;

use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use App\Domain\Core\Repository\Repository;

use function DI\string;

class LoginMiddleware
{
    private Error $error;
    private Repository $repository;

    /**
     * @param Error $error
     * @param Repository $repository
     */
    public function __construct(Error $error, Repository $repository)
    {
        $this->error = $error;
        $this->repository = $repository;
    }

    /**
     * @param ServerRequestInterface $request
     * @param RequestHandlerInterface $handler
     * @return ResponseInterface
     */
    public function __invoke(ServerRequestInterface $request, RequestHandlerInterface $handler):ResponseInterface
    {
        //Get JWT
        if (isset($_SERVER['HTTP_AUTHORIZATION']))
        {
            $authHeader = $_SERVER['HTTP_AUTHORIZATION'];
            $arr = explode(" ",(string($authHeader)));
            if ($arr[0] = "Bearer")
            {
                $jwt = $arr[1];
                if ($jwt)
                {
                    if ($this->repository->decodeToken($jwt))
                        return $handler->handle($request);
                    else{
                        $response = new Response();
                        return $this->error->setErrors($response, 401, 'Unauthorized');
                    }
                }else
                {
                    $response = new Response();
                    return $this->error->setErrors($response, 404, 'Token not found');
                }
            }
            else{
                $response = new Response();
                return $this->error->setErrors($response, 401, 'Unauthorized');
            }
        }
        else
        {
            $response = new Response();
            return $this->error->setErrors($response, 401, "Not Authorization header");
        }
    }

}