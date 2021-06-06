<?php
namespace Src\Infrastructure\Repositories;
use \PDO;
use Src\Infrastructure\Data\DbContext;
use Src\Dominio\Entities\Usuario\Empleado;

class SecurityRepository //implements UserRepositoryInterface
{
    private $_db;
    public function __construct(){
        $this->_db=DbContext::get();
    }

    public function findByUserEmpleado(string $userName):?Empleado{
        $result=null;
        $stm = $this->_db->prepare('SELECT * FROM empleado where emp_usuario=:userName');
        $stm->execute(['userName' =>$userName]);
        $data = $stm->fetchObject('\\Src\\Dominio\\Entities\\Usuario\\Empleado');
        if ($data) {
            $result = $data;
        }
        return $result;
    }




}