<?php
namespace Src\Infrastructure\Services;

use PDO;
use PDOException;
// use PDO;
 // use Kodoti\Database\DbProvider;
use Src\Infrastructure\Repositories\UserRepository;
use Src\Infrastructure\Interfaces\UserServiceInterface;

// use Src\Dominio\Entities\User;

class UserService //implements UserServiceInterface
{
    private $_userRepository;
    
    public function __construct()
    {
        $this->_userRepository = new UserRepository();
    }
    
    private $userRepository;
    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }



    public function getUsersByPage(array $params) //: array
    {
        $result = [];

        try {

           
           // $page_number=$params['page_number'];
         
           // $page_size=$params['page_size'];
        //    $user_name=$params['user_name'];
           $user_name='juan';
            $page_number=1;
            $page_size=10;
            // $result=$this->_userRepository->findAll();
            
            $result=$this->_userRepository->getUsersByPage($page_number,$page_size,$user_name);

        } catch (PDOException $ex) {

        }

        return $result;
    }

    public function get(int $id): ?User
    {
        $result = null;

         try {
            $result=$this->_userRepository->findById($id);
            return $result;
        } catch (PDOException $ex) {

        }
    }

    public function create(User $model) //: void
    {
        try {
            $passwod=$model->password;
            // return $passwod;
            $model->password=password_hash($passwod, PASSWORD_DEFAULT);
            $result=$this->_userRepository->add($model);
 
         } catch (PDOException $ex) {

        }
    }

    public function update(User $model): void
    {
        try {
            $result=$this->_userRepository->edit($model);
        } catch (PDOException $ex) {
            
        }
    }

    public function delete(int $id): void
    {
        try {
            $result=$this->_userRepository->removeById($id);
        } catch (PDOException $ex) {

        }
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
