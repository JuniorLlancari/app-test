<?php
namespace Src\Infrastructure\Services;

// use PDO;
use PDOException;
 // use Kodoti\Database\DbProvider;
use Src\Infrastructure\Repositories\ProductRepository;
use Src\Dominio\Entities\Product;

class ProductService
{
    private $_productRepository;

    public function __construct()
    {
        $this->_productRepository = new ProductRepository();
    }
    
    public function getAll(): array
    {
        $result = [];

        try {
            $result=$this->_productRepository->findAll();
        } catch (PDOException $ex) {

        }

        return $result;
    }

    public function get(int $id): ?Product
    {
        $result = null;

         try {
            $result=$this->_productRepository->findById($id);
            return $result;
        } catch (PDOException $ex) {

        }
    }

    public function create(Product $model): void
    {
        try {
 
            $result=$this->_productRepository->add($model);
 
         } catch (PDOException $ex) {

        }
    }

    public function update(Product $model): void
    {
        try {
            $result=$this->_productRepository->edit($model);
        } catch (PDOException $ex) {
            
        }
    }

    public function delete(int $id): void
    {
        try {
            $result=$this->_productRepository->removeById($id);
        } catch (PDOException $ex) {

        }
    }
 
}
