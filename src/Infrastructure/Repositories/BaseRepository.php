<?php
declare(strict_types=1);

namespace Src\Infrastructure\Repositories;
use Src\Infrastructure\Data\DbContext;
use Interop\Container\ContainerInterface;
 // use \PDO;

abstract class BaseRepository
{
 
    public $_db;
    public function __construct(){
        $this->_db=DbContext::get();
    }
    // public function __construct(ContainerInterface $container)
    // {
    //     $this->_db = $container['db'];
    //  }
 
 
    public function getResultsWithPagination(
        string $query,
        int $pageNumber,
        int $pageSize,
        array $params,
        int $total
    ): array {

        return [
            'pagination' => [
                'currentPage' => $pageNumber,
                'totalPages' => ceil($total / $pageSize),
                'pageSize' => $pageSize,
                'totalRows' => $total,
                "hasPreviousPage"=> true,
                "hasNextPage"=> true,
                "nextPageUrl"=> "string",
                "previousPageUrl"=> "string"
            ],
            'data' => $this->getResultByPage($query, $pageNumber, $pageSize, $params),
        ];

    }

    public function getResultByPage(
        string $query,
        int $pageNumber,
        int $pageSize,
        array $params
    ){

        $_db=DbContext::get();
        $offset = ($pageNumber - 1) * $pageSize;
        $query .= " LIMIT ${pageSize} OFFSET ${offset}";
        $stm =$_db->prepare($query);
 
        // return $stm;
        $stm->bindParam(':first_name',$params['first_name']);
        $stm->execute();


        return  $stm->fetchAll();

 


    }
}
