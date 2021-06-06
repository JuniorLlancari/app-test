<?php
namespace Src\Infrastructure\Services;

use PDO;
use PDOException;
// use PDO;
 // use Kodoti\Database\DbProvider;
use Src\Infrastructure\Repositories\SecurityRepository;
use Src\Dominio\Entities\Usuario\Empleado;
use Src\Dominio\Entities\Usuario\SecurityEmpleado;

class SecurityService
{
    private $_securityRepository;

    public function __construct()
    {
        $this->_securityRepository = new SecurityRepository();
    }

    public function GetCredentialsByEmpleado(string $userName) //: Empleado
    {
        // $result = null;}

         try {
            
            
             
             
             $result=$this->_securityRepository->findByUserEmpleado($userName);
             return $result;
            //$emp=new Empleado();
            // $emp->setIdEmpleado($result->id_empleado);
            // $emp->setNombres($result->emp_nombres);
            // $emp->setApellidos($result->emp_apellidos);
            // $emp->setUsuario($result->emp_usuario);
            // $emp->setPassword($result->emp_password);
            // $emp->setEmail($result->emp_email);
            // $emp->setDni($result->emp_dni);
            // $emp->setDireccion($result->emp_direccion);
            // $emp->setCelular($result->emp_celular);
            // return $emp;//->getNombres();
        } catch (PDOException $ex) {

        }
    }


    

    public function GetSecurityEmpleado(Empleado $emp)
    {
        $result = null;
             try {
                $security =new SecurityEmpleado();
                $security->setIdEmpleado($emp->getIdEmpleado());
                $security->setNombres($emp->getNombres());
                $security->setApellidos($emp->getApellidos());
                $security->setEmail($emp->getEmail());
                return $security->data;
            } catch (PDOException $ex) {
                return false;
        }
    }

}
