<?php
namespace Src\Infrastructure\Repositories;
use \PDO;
use Src\Dominio\Entities\User;
use Src\Infrastructure\Data\DbContext;

use Interop\Container\ContainerInterface;
use Src\Dominio\Interfaces\UserRepositoryInterface;

class UserRepository extends BaseRepository //implements UserRepositoryInterface
{

    // private $_db;
    // public function __construct(){
    //     $this->_db=DbContext::get();
    // }

    public function __construct()
    {   
        // $this->_db = $container['db'];
        $this->_db=DbContext::get();

    }


    public function findAll():array{

        $result=null;
        $stm = $this->_db->prepare('SELECT * FROM users');
        $stm->execute();
        $data = $stm->fetchAll(PDO::FETCH_CLASS,User::class);
        if($data){
            $result = $data;
        }
        return $result;
    }


    public function getUsersByPage(
        int $pageNumber,
        int $pageSize,
        ?string $name,
    ) {
         
        $params = [
            'first_name' => is_null($name) ? '' : $name
        ];
        // $first_name='mari';
        $query = $this->getQueryUsersByPage();
        $stm = $this->_db->prepare($query);
        $stm->bindParam(':first_name',$params['first_name']);
        $stm->execute();
        $total = $stm->rowCount();
        $data = $stm->fetchAll();

        return $this->getResultsWithPagination(
            $query,
            $pageNumber,
            $pageSize,
            $params,
            $total
        );
        
    }

    public function getQueryUsersByPage(): string
    {
        //return "SELECT * FROM `users` limit 1";//WHERE `first_name` LIKE CONCAT('%', :first_name, '%')  ";
        return "SELECT * FROM `users` WHERE `first_name` LIKE CONCAT('%', :first_name, '%') ORDER BY `id`";
    }



 












    
    public function findById(int $id): ?User{

        $result=null;

        $stm = $this->_db->prepare('SELECT * FROM users WHERE id = :id');
        $stm->execute(['id' => $id]);

        $data = $stm->fetchObject(User::class);
 
        //En caso reorne False
        if ($data) {
            $result = $data;
        }
        return $result;

    }

    public function add(User $user): void{
       
        $stm=$this->_db->prepare('INSERT INTO users (first_name, last_name,user_name, password, created_at, updated_at)
        VALUES(:first_name,:last_name,:user_name,:password,:created_at,:updated_at)');
        $stm->execute([
        'first_name' => $user->first_name,
        'last_name' =>  $user->last_name,
        'user_name' =>  $user->user_name,
        'password' =>$user->password,
        'created_at' => $user->created_at,
        'updated_at' => $user->updated_at
        ]);
        $user->id = $this->_db->lastInsertId();
        
    }

    public function edit(User $user): void{

        $stm=$this->_db->prepare('UPDATE users SET 
            first_name=:first_name,
            last_name=:last_name, 
            user_name=:user_name,
            password=:password, 
            updated_at=:updated_at WHERE id=:id');
        $stm->execute([
        'first_name' => $user->first_name,
        'last_name' =>  $user->last_name,
        'user_name' =>  $user->user_name,
        'password' =>$user->password,
        'updated_at' => $user->updated_at,
        'id' => $user->id]);
    }

    public function removeById(int $id): void{
        $stm=$this->_db->prepare('DELETE FROM users WHERE id= :id');
        $stm->execute(['id' => $id]);
    }

 


}