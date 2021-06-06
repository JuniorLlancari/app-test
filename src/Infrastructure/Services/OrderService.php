<?php
namespace Src\Infrastructure\Services;

use \PDO;
use \PDOException;
use Src\Dominio\Entities\User;
use Src\Dominio\Entities\Order;
use Src\Infrastructure\Data\DbContext;
use Src\Infrastructure\Repositories\UserRepository;
use Src\Infrastructure\Repositories\OrderRepository;
use Src\Infrastructure\Repositories\ProductRepository;
use Src\Infrastructure\Repositories\OrderDetailRepository;
use Src\Dominio\Entities\Product;


class OrderService
{
    private $_db;
    private $_userRepository;
    private $_orderRepository;
    private $_productRepository;
    private $_orderDetailRepository;

    public function __construct()
    {

        $this->_db = DbContext::get();
        $this->_userRepository = new UserRepository;
        $this->_productRepository =  new ProductRepository;
        $this->_orderRepository =  new OrderRepository;
        $this->_orderDetailRepository = new OrderDetailRepository;

    }

    public function get(int $id): ?Order
    {
        $result = null;

        try {
            $data=$this->_orderRepository->find($id);

            if ($data) {
                $result = $data;

                // Client
                $result->client = $this->_userRepository->findById($result->user_id);

                // Creater
                $result->creater = $this->_userRepository->findById($result->creater_id);

                // Detail
                $result->detail = $this->getDetail($result->id);
            }
        } catch (PDOException $ex) {
            var_dump($ex);
        }

        return $result;
    }

    private function getDetail(int $order_id): array
    {
        $result=$this->_orderDetailRepository->findAllByOrderId($order_id);
        foreach ($result as $item) {
            $item->product=$this->_productRepository->findById($item->product_id);
        }
        return $result;
    }

    public function create(Order $model)//: void
    {
        try {
            // Begin transacation
           $this->_db->beginTransaction();

            $this->_orderRepository->add($model);

            // Order Detail creation
            $this->_orderDetailRepository->addByOrderId($model->id,$model->detail);

            // Commit transaction
            $this->_db->commit();
        } catch (PDOException $ex) {
           $this->_db->rollBack();
        }
    }

    
    
    public function getAll() //: array
    {
        $result = [];

        try {

           
         
            // $result=$this->_userRepository->findAll();
            
            $result=$this->_orderRepository->findAll();
            
        } catch (PDOException $ex) {

        }

        return $result;
    }


 
}

 