<?php
namespace Src\Controllers;

use PDOException;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Src\Infrastructure\Repositories\ProductRepository;
use Src\Infrastructure\Services\ProductService;
use Src\Dominio\Entities\Product;
use Src\Controllers\BaseController;

 
class ProductController extends BaseController{

 
    
 
    public function ProductGetController(Request $request, Response $response,array $args){
        
        try{
            $data=$this->_container->product_service->getAll();
            return $this->showAll($response,$data);
        }catch(PDOException $ex){
            return  $response->withJson(['msg'=>$ex->getMessage()]);        
        }
    }

    public function ProductGetByIdController(Request $request, Response $response,array $args){
        
        try{
             
             $data=$this->_container->product_service->get($args['id']);
             return $this->showOne($response,$data);

         }catch(PDOException $ex){
            $status=$ex->getCode();$msg=$ex->getMessage();
            return  $response->withJson($msg,$status);        
        }
    }

    public function ProductUpdateController(Request $request, Response $response,array $args){
        
        
        try{
            $body= $request->getParsedBody();
            $model=new Product();
            $model->id=$args['id'];
            $model->name=$body['name'];
            $model->price=$body['price'];
            $this->_container->product_service->update($model);
            return $this->showOne($response,$model);

        }catch(PDOException $ex){
            return  $response->withJson(['msg'=>$ex->getMessage()]);        
        }
    }

    public function ProductInsertController(Request $request, Response $response,array $args){
        
        try{

            $body= $request->getParsedBody();
            // $data = $request->getParam('items');
            $model=new Product();
            $model->name=$body['name'];
            $model->price=$body['price'];

            $this->_container->product_service->create($model);
            return $this->showOne($model);
        }catch(PDOException $ex){
            return  $response->withJson(['msg'=>$ex->getMessage()]);        
        }
    }

    public function ProductDeleteController(Request $request, Response $response,array $args){
        
        try{
            $id=$args['id'];
            $this->_container->product_service->delete($id);
            return $this->showOne(null);
        }catch(PDOException $ex){
            return  $response->withJson(['msg'=>$ex->getMessage()]);        
        }
    }



}
