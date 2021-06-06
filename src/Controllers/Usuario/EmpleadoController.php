<?php
namespace Src\Controllers\Usuario;

use \PDOException;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Src\Infrastructure\Repositories\UserRepository;
use Src\Dominio\Entities\User;
use Src\Infrastructure\Services\UserService;
use Src\Infrastructure\Interfaces\UserServiceInterface;
use Interop\Container\ContainerInterface;
use Src\Controllers\BaseController;

class EmpleadoController extends BaseController {


    public function UserGetController(Request $request, Response $response,array $args){
        
        try{
            
            $params=$request->getQueryParams();
            // return  $response->withJson(['data'=>$params]);        
            $data=$this->_container->empleadoService->getUsersByPage($params);
            return $this->showAll($response,$data);
        }catch(PDOException $ex){
            $msg=$ex->getMessage();   
            return $this->errorResponse($response,$msg,400);
     
        }
    }

    public function UserGetByIdController(Request $request, Response $response,array $args){
        
        try{
            
            $id=$args['id'];
            $data=$this->_container->empleadoService->get($id);
            return $this->showOne($response,$data);

        }catch(PDOException $ex){
             return $this->errorResponse($response,$ex->getMessage(),400);        
        }
    }

     
    public function EmpleadoGetController(Request $request, Response $response,array $args){
        
        try{
            
            //$params=$request->getQueryParams();
            // return  $response->withJson(['data'=>$params]);        
            $data=$this->_container->empleadoService->getEmpleados();
            return $this->showAll($response,$data);
        }catch(PDOException $ex){
            $msg=$ex->getMessage();   
            return $this->errorResponse($response,$msg,400);
     
        }
    }


    public function UserUpdateController(Request $request, Response $response,array $args){
        
        
        try{
            $body= $request->getParsedBody();
 
            $now = date('Y-m-d H:i:s');            
            $user=new User();
            $user->id=$args['id'];
            $user->first_name=$body['first_name'];
            $user->last_name=$body['last_name'];
            $user->user_name=$body['user_name'];
            $user->password=$body['password'];
            $user->updated_at=$now;
            $this->_container->empleadoService->editUser($user);
            $dataId=$this->_container->empleadoService->getUserOfId($args['id']);
            return $this->showOne($response,$data);

        }catch(PDOException $ex){
            return  $response->withJson(['msg'=>$ex->getMessage()]);        
        }
    }

    public function UserInsertController(Request $request, Response $response,array $args){
        
        try{
            $body= $request->getParsedBody();

            
            // $data = $request->getParam('items');

            $now = date('Y-m-d H:i:s');            
            $user=new User();
            $user->first_name=$body['first_name'];
            $user->last_name=$body['last_name'];
            $user->user_name=$body['user_name'];
            $user->password=$body['password'];
            $user->created_at=$now;
            $user->updated_at=$now;
            $data=$this->_container->empleadoService->create($user);
            return $this->showOne($response,$data);
        }catch(PDOException $ex){
            return  $response->withJson(['msg'=>$ex->getMessage()]);        
        }
    }

    public function UserDeleteController(Request $request, Response $response,array $args){
        
        try{
            $id=$args['id'];
            $dataId=$this->_container->empleadoService->deleteUser($id);
            return $this->showOne($response,$data);
        }catch(PDOException $ex){
            return  $response->withJson(['msg'=>$ex->getMessage()]);        
        }
    }








    

    /*
    public function UserPostController(Request $request, Response $response,array $args){
        //return  $response->withJson('sd');
        $dotenv = Dotenv::createImmutable('./');
        $dotenv->load();
        $contenido='hola';

 
    
        $s3_bucket =$_ENV["API_KEY"];
 

         
        try{
            $now = date('Y-m-d H:i:s');
            $data = $request->getParsedBody();
            $obj_user=new User();
            $obj_user->first_name=$data['first_name'];
            $obj_user->last_name=$data['last_name'];
            $obj_user->user_name=$data['user_name'];
            $obj_user->user_password=$data['user_password'];
            $obj_user->created_at=$now;
            $obj_user->updated_at=$now;

            
            $this->obj_UserService->create($obj_user);
             
          





           return  $response->withJson($obj_user);

        }catch(PDOException $ex){
            return  $response->withJson(['msg'=>$ex->getMessage()]);

            
        }


        //$data = $request->getParsedBody();  

       
    }
    
*/


}
