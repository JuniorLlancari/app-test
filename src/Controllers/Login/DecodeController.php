<?php

namespace Src\Controllers\Login;

use PDOException;
use Firebase\JWT\JWT;
use Ramsey\Uuid\Uuid;
 
use Src\Dominio\Entities\User;
use Src\Dominio\Entities\Login;

use Psr\Http\Message\UploadedFile;
use Src\Dominio\Entities\Security;
use Src\Controllers\BaseController;

use Src\Controllers\Login\Lib\Auth;
use Src\Dominio\Entities\Usuario\Empleado;
use Src\Infrastructure\Services\UserService;
use Src\Infrastructure\Services\SecurityService;
use Src\Dominio\Entities\Usuario\SecurityEmpleado;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\UploadedFileInterface as FileInterface;


date_default_timezone_set("America/Lima");


class DecodeController extends BaseController
{
      
    public function DecodeToken(Request $request, Response $response, array $args)
    {

        $jwtHeader = $request->getHeaderLine('x-api-key');
        if (! $jwtHeader) {
            return  $response->withJson('JWT Token required.', 400);
        }
        $jwt = explode('Bearer ', $jwtHeader);
        if (! isset($jwt[1])) {
            return  $response->withJson('JWT Token invalid.', 400);
        }
        

        $decoded = Auth::Check($jwt[1]);
        // return $response->withJson($jwt);

        if($decoded){

            //($jwtHeader)
            //return $response->withJson($jwt[1]);
            $data=Auth::GetData($jwt[1]);
            
            // return $response->withJson( $data);
            return $this->showOne($response,$data);

        }
        return $response->withJson($decoded);
        // return $this->showOne($isValid);
        // return $this->showOne($response,['encode'=>$isValid]);
    }

    


}