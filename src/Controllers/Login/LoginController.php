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


class LoginController extends BaseController
{
     

    // public function Login(Request $request, Response $response, array $args)
    // {
    //     $body= $request->getParsedBody();
    //     $login=new Login;
    //     $login->user_name=$body['userName'];
    //     $login->password=$body['password'];
    //     $isValid = $this->IsValidUser($login);
    //     return $this->showOne($response,['encode'=>$isValid]);
    // }

    public function IsValidEmpleado(Login $login)
    {
         
        $result=$this->_container->security_service->GetCredentialsByEmpleado($login->getUserName());
        
        if($result){
           // return $data;
            $emp=new Empleado();

            $emp->setIdEmpleado($result->id_empleado);
            $emp->setNombres($result->emp_nombres);
            $emp->setApellidos($result->emp_apellidos);
            $emp->setUsuario($result->emp_usuario);
            $emp->setPassword($result->emp_password);
            $emp->setEmail($result->emp_email);
            $emp->setDni($result->emp_dni);
            $emp->setDireccion($result->emp_direccion);
            $emp->setCelular($result->emp_celular);
            
            
            
            if (password_verify($login->getPassword(), $emp->getPassword())) {
               // return $emp->getDireccion();
                //$valor= $this->_container->security_service->GetSecurityEmpleado($emp);
                
                $security=new SecurityEmpleado();
                $security->setIdEmpleado($emp->getIdEmpleado());
                $security->setNombres($emp->getNombres());
                $security->setApellidos($emp->getApellidos());
                $security->setEmail($emp->getEmail());

                $data=[
                    "idEmpleado"=> $security->getIdEmpleado(),
                    "nombres"=> $security->getNombres(),
                    "getApellidos"=> $security->getApellidos(),
                    "email"=> $security->getEmail()
                ];

                return Auth::SignIn($data);
            }else{
                throw new Exception("Exception message");            
            }
        }
        return false;
    }
   
    public function LoginEmpleado(Request $request, Response $response, array $args)
    {
        $body= $request->getParsedBody();
        $login=new Login;
        $login->setUserName($body['userName']);
        $login->setPassword($body['password']);
        $isValid = $this->IsValidEmpleado($login);
        // return $response->withJson($isValid );

        return $this->showOne($response,$isValid);

        // return $this->showOne($isValid);
        // return $this->showOne($response,['encode'=>$isValid]);
    }

    public function LoginTest(Request $request, Response $response, array $args)
    {
         
        return $response->withJson('Junior ssi' );

        // return $this->showOne($response,$isValid);

        // return $this->showOne($isValid);
        // return $this->showOne($response,['encode'=>$isValid]);
    }


}