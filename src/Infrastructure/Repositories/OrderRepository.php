<?php 

namespace Src\Infrastructure\Repositories;
use Src\Infrastructure\Data\DbContext;
// use Src\Dominio\Interfaces\UserRepositoryInterface;
use Src\Dominio\Entities\Order;
use \PDO;

class OrderRepository{

    private $_db;

    public function __construct(){
        $this->_db=DbContext::get();
    }

    public function add(Order &$model): void
    {
        $stm = $this->_db->prepare('
            insert into orders(user_id, total, creater_id, created_at, updated_at)
            values(:user_id, :total, :creater_id, :created, :updated)
        ');

        $stm->execute([
            'user_id' => $model->user_id,
            'total' => $model->total,
            'creater_id' => $model->creater_id,
            'created' => $model->created_at,
            'updated' => $model->updated_at,
        ]);
        //Llenamos el id generado
        $model->id = $this->_db->lastInsertId();
    }

    public function find(int $id) :Order{
        
        $result=null;
        $stm = $this->_db->prepare('SELECT * FROM orders WHERE id = :id');
        $stm->execute(['id' => $id]);

        $data = $stm->fetchObject('Src\\Dominio\\Entities\\Order');
        //En caso reorne False
        if ($data) {
            $result = $data;
        }
        return $result;

    }

    public function findAll():array{

        $result=null;
        $stm = $this->_db->prepare('SELECT * FROM orders');
        $stm->execute();
        $data = $stm->fetchAll();
        if($data){
            $result = $data;
        }
        return $result;
    }


}