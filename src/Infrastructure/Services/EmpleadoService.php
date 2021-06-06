<?php
namespace Src\Infrastructure\Services;

use PDO;
use PDOException;
// use PDO;
 // use Kodoti\Database\DbProvider;
use Src\Infrastructure\Repositories\EmpleadoRepository;
// use Src\Infrastructure\Interfaces\UserServiceInterface;

// use Src\Dominio\Entities\User;

class EmpleadoService //implements UserServiceInterface
{
    private $_empleadoRepository;

    public function __construct()
    {
        $this->_empleadoRepository = new EmpleadoRepository();
    }

     
    public function getEmpleados() //: array
    {
        $result = [];

        try {

           
           // $page_number=$params['page_number'];
         
           // $page_size=$params['page_size'];
        //    $user_name=$params['user_name'];
        //    $user_name='juan';
        //     $page_number=1;
        //     $page_size=10;
            // $result=$this->_userRepository->findAll();
            
            $result=$this->_empleadoRepository->findAll();

        } catch (PDOException $ex) {

        }

        return $result;
    }
 

 

















/*
    public function create(User $model)
    {
        try {
            // Begin transacation
            $this->_db->beginTransaction();
            // Prepare order creation
           $this->_userRepository->add($model);
           
            // Order creation
           $this->_orderRepository->addEstudiante($model);
            //var_dump($model);
            // Order Detail creation
            // Commit transaction
            $this->_db->commit();
        } catch (PDOException $ex) {
           $this->_db->rollBack();
        }
    }

    public function get(int $id): ?User
    {
        $result = null;


        try{

            $result=$this->_userRepository->find($id);

        } catch (PDOException $ex) {

        }
    }

    public function getAll()
    {
        $result = null;


        try{

            $result=$this->_userRepository->find($id);

        } catch (PDOException $ex) {

        }
    }

    //preparamos los subtotales
    private function prepareOrderCreation(Order &$model): void
    {
        $now = date('Y-m-d H:i:s');

        $model->created_at = $now;
        $model->updated_at = $now;

        foreach ($model->detail as $item) {
            $item->total = $item->price * $item->quantity;

            $item->created_at = $now;
            $item->updated_at = $now;

            $model->total += $item->total;
        }
    }
*/



}
