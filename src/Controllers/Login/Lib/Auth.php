<?php 
declare(strict_types=1);

namespace Src\Controllers\Login\Lib;
use Firebase\JWT\JWT;
 
class Auth
{

    public static function SignIn($data)
    {
        $time = time();
        $token = array(
            'iat'=>$time ,
            'nbf'=>$time,
            'exp' => $time + (60*60),
            'aud' => null,
            'data' => $data
        );

        return JWT::encode($token, $_SERVER['SECRET_KEY']);
    }

    public static function Check($token)
    {

        try{
            $decode = JWT::decode($token,$_SERVER['SECRET_KEY'], [$_SERVER['ENCRYPT']]);
            return ["ok"=>true];           
        }catch(\Exception $ex){
            return ["ok"=>false,"exception"=>$ex];           
        }
        
    }

    public static function GetData($token)
    {
        return JWT::decode($token,$_SERVER['SECRET_KEY'], [$_SERVER['ENCRYPT']])->data;
    }

   
}



