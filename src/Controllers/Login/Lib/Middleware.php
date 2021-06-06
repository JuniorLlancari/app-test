<?php
namespace Src\Controllers\Login\Lib;

use Src\Controllers\Login\Lib\Auth;
use Firebase\JWT\JWT;
use Firebase\JWT\ExpiredException;


class Middleware
{

    public $roles=[];
 

    public function __invoke($request, $response, $next){
        

            $jwtHeader = $request->getHeaderLine('x-api-key');
     
            if (! $jwtHeader) {
                return  $response->withJson('JWT Token required.', 400);
            }
            $jwt = explode('Bearer ', $jwtHeader);
            if (! isset($jwt[1])) {
                return  $response->withJson('JWT Token invalid.', 400);
            }

            $decoded = Auth::Check($jwt[1]);

            if(!$decoded['ok']){
                $exception=$decoded['exception'];
                $msg=$exception->getMessage();
                $data=[
                    "msg"=>$msg,
                    "code"=>403
                ];
                return $response->withJson($data,403);
            }
            
            $object = (array) $request->getParsedBody();
            $object['decoded'] = $decoded;
            return $next($request->withParsedBody($object), $response);
        
    }  
         
}
