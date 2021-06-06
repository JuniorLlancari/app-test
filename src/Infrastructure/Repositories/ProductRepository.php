<?php 

namespace Src\Infrastructure\Repositories;
use Src\Infrastructure\Data\DbContext;
// use Src\Dominio\Interfaces\UserRepositoryInterface;
use Src\Dominio\Entities\Product;
use \PDO;

class ProductRepository{
    private $_db;

    public function __construct(){
        $this->_db=DbContext::get();
    }

    public function findById(int $id) : ?Product
    {
        $result=null;

        $stm = $this->_db->prepare('select * from products where id = :id');
        $stm->execute(['id' => $id]);

        $data = $stm->fetchObject('Src\\Dominio\\Entities\\Product');
        //En caso reorne False
        if ($data) {
            $result = $data;
        }
        return $result;

    }

    public function findAll(): array
    {
            $result = [];

            $stm = $this->_db->prepare('SELECT * FROM products');
            // 02. Execute query     
            $stm->execute();
            // 03. Fetch All
            $result = $stm->fetchAll(PDO::FETCH_CLASS, Product::class);
            return $result;
    }

    public function add(Product $model): void
    {
        
        $stm = $this->_db->prepare(
            'insert into products(name, price, created_at, updated_at) values (:name, :price, :created, :updated)'
        );
        $now = date('Y-m-d H:i:s');
        $stm->execute([
            'name' => $model->name,
            'price' => $model->price,
            'created' => $now,
            'updated' => $now,
        ]);
        $model->id = $this->_db->lastInsertId();

    }

    public function edit(Product $model): void
    {
      
            $stm = $this->_db->prepare('
                update products
                set name = :name,
                    price = :price,
                    updated_at = :updated
                where id = :id
            ');

            $stm->execute([
                'name' => $model->name,
                'price' => $model->price,
                'updated' => date('Y-m-d H:i:s'),
                'id' => $model->id,
            ]);
      
    }

    public function removeById(int $id): void
    {
      
            $stm = $this->_db->prepare(
                'delete from products where id = :id'
            );

            $stm->execute(['id' => $id]);
   
    }


}