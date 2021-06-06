<?php

declare(strict_types=1);
 
use Slim\App;
use Src\Controllers\Login;
use Src\Controllers\OrderController;
use Src\Controllers\ProductController;
use Src\Controllers\Login\Lib\Middleware;;
use Src\Infrastructure\Services\UserService;
use Src\Controllers\Usuario\EmpleadoController;



//delivery.com/api/v1/LoginEmpleado
// empleado
// /api/v1/empleado
$app->group('/api', function ()  {
   
    $this->GROUP('/v1', function () {
        
        $this->POST('/loginEmpleado', Login\LoginController::class . ':LoginEmpleado');
        $this->GET('/decode', Login\DecodeController::class . ':DecodeToken')->add(new Middleware());
        $this->GET('/test', Login\LoginController::class . ':LoginTest');//->add(new Middleware());


        $this->GROUP('/empleado', function () {
            $this->GET('', EmpleadoController::class . ':EmpleadoGetController');
        });
        
        
        //->add(new Middleware());


        // $this->GROUP('/user', function () {
        //     $this->GET('',  User\UserController::class . ':UserGetController');
        //     $this->GET('/{id}',User\UserController::class . ':UserGetByIdController');
        //     $this->POST('', User\UserController::class . ':UserInsertController');
        //     $this->PUT('/{id}', User\UserController::class . ':UserUpdateController');
        //     $this->DELETE('/{id}',User\UserController::class . ':UserDeleteController');
        // });//->add(new Middleware());

        // $this->GROUP('/product', function () {
        //     $this->GET('', ProductController::class . ':ProductGetController');
        //     $this->GET('/{id}',ProductController::class . ':ProductGetByIdController');
        //     $this->POST('', ProductController::class . ':ProductInsertController');
        //     $this->PUT('/{id}', ProductController::class . ':ProductUpdateController');
        //     $this->DELETE('/{id}',ProductController::class . ':ProductDeleteController');
        // });

        // $this->GROUP('/order', function () {
        //     $this->GET('', OrderController::class . ':OrderGetController');
        //     $this->GET('/{id}',OrderController::class . ':OrderGetByIdController');
        //     $this->POST('', OrderController::class . ':OrderInsertController');
        //     $this->PUT('/{id}', OrderController::class . ':OrderUpdateController');
        //     $this->DELETE('/{id}',OrderController::class . ':OrderDeleteController');
        // });
    });

    // $this->GROUP('/v2', function () {


    //     $this->GROUP('/test', function () {
    //         $this->GET('',  ProductController::class . ':testController');
    //     });
    // });

    // $this->GET('/prueba',function($request,$response) //use($objUser)
    // {
    //     return $this->get('user_repository');
    // });

});

// http://localhost:8080/app-delivery/api/v1/user
// https://console.clever-cloud.com/users/me/addons/addon_c0c2f932-5f0a-42ff-ab28-2c20c9c95936