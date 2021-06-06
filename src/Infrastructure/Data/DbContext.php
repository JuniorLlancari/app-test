<?php
namespace Src\Infrastructure\Data;
use Dotenv\Dotenv;
use PDO;


class DbContext
{
    private static $_db;
    
    // CADA VEZ QUE SE LLAMA ,LLAMARA A LA VARIABLE
    public static function get()
    {

        //SI NO HA SIDO CREADA
        if(!self::$_db) {

            $dotenv = Dotenv::createImmutable(__DIR__ . '/../../../');
            $dotenv->load();
            
            $DB_NAME =$_ENV['DB_NAME'];
            $DB_HOST =$_ENV['DB_HOST'];
            $DB_USER =$_ENV['DB_USER'];
            $DB_PASS =$_ENV['DB_PASS'];
            $CHARSET =$_ENV['CHARSET'];
            $CADENA="mysql:host=$DB_HOST;dbname=$DB_NAME;charset=$CHARSET";
            $pdo = new PDO($CADENA,$DB_USER,$DB_PASS);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            self::$_db = $pdo;
        }
        return self::$_db;

    }
}


