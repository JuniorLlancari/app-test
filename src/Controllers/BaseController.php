<?php

declare(strict_types=1);

namespace Src\Controllers;

use \PDOException;
use Src\Controllers\ApiResponser;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
// use Src\Infrastructure\Services\OrderService;
use Interop\Container\ContainerInterface;

abstract class BaseController
{
    use ApiResponser;

    protected  $_container;

    public function __construct(ContainerInterface $container)
    {
        $this->_container = $container;
     }

    
    protected function jsonResponse(
        Response $response,
        string $status,
        $message,
        int $code
    ): Response {
        $result = [
            'code' => $code,
            'status' => $status,
            'message' => $message,
        ];
           
 
        return $response->withJson($result, $code, JSON_PRETTY_PRINT);
    }

   
}
