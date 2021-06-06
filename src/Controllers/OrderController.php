<?php
namespace Src\Controllers;

use PDOException;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Src\Infrastructure\Services\OrderService;

use Src\Dominio\Entities\Order;
use Src\Dominio\Entities\OrderDetail;
use Src\Controllers\BaseController;

 
class OrderController extends BaseController{
      
    public function OrderGetController(Request $request, Response $response,array $args){
        
        try{
            $data=$this->_container->order_service->getAll();
             return $this->showAll($response,$data);
        }catch(PDOException $ex){
            return  $response->withJson(['msg'=>$ex->getMessage()]);        
        }
    }

    public function OrderGetByIdController(Request $request, Response $response,array $args){
        
        try{
            $now = date('Y-m-d H:i:s');            
            $id=$args['id'];
            $data=$this->_container->order_service->get($id);
            return $this->showOne($response,$data);

        }catch(PDOException $ex){
            return  $response->withJson(['msg'=>$ex->getMessage()]);        
        }

    }

    public function OrderUpdateController(Request $request, Response $response,array $args){
        
        
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
            $this->_container->order_service->editUser($user);
            $data=$this->_container->order_service->getUserOfId($args['id']);
            return $this->showOne($response,$data);
        }catch(PDOException $ex){
            return  $response->withJson(['msg'=>$ex->getMessage()]);        
        }
    }

    public function OrderInsertController(Request $request, Response $response,array $args){
        
        try{
            $body= $request->getParsedBody();
 
            $now = date('Y-m-d H:i:s');            
            $model=new Order();
            $model->user_id=$body['user_id'];
            $model->creater_id=$body['creater_id'];
            $model->created_at=$now;
            $model->updated_at=$now;
            $this->prepareOrderCreation($model,$body['detail']);
             $data=$this->_container->order_service->create($model);
            return $this->showOne($response,$data);
        }catch(PDOException $ex){
            return  $response->withJson(['msg'=>$ex->getMessage()]);        
        }
    }

    public function prepareOrderCreation(Order $order,array $model){
        
        try{

            $now = date('Y-m-d H:i:s');            

            foreach ($model as $item) {

                $detail=new OrderDetail();
                $detail->product_id=$item['product_id'];
                $detail->price=$item['price'];
                $detail->quantity=$item['quantity'];
                $detail->total = $detail->price * $detail->quantity;
                $detail->created_at = $now;
                $detail->updated_at = $now;
                $order->total += $detail->total;
                $order->detail[] = $detail;
            }


        }catch(PDOException $ex){
            return  $response->withJson(['msg'=>$ex->getMessage()]);        
        }
    }

    public function OrderDeleteController(Request $request, Response $response,array $args){
        
        try{
            $id=$args['id'];
            $data=$this->_container->order_service->deleteUser($id);
            return $this->showOne($response,$data);        }
        catch(PDOException $ex){
            return  $response->withJson(['msg'=>$ex->getMessage()]);        
        }
    }

}
