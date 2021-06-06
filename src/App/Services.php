<?php

declare(strict_types=1);


use Psr\Container\ContainerInterface;
use Src\Infrastructure\Services\EmpleadoService;
use Src\Infrastructure\Services\SecurityService;


// $container['security_Service'] = new SecurityService;
// $container['empleadoService'] = new EmpleadoService;


$container['empleadoService'] = static fn (ContainerInterface $container): EmpleadoService => new EmpleadoService($container->get('empleadoRepository')
 );

 

 $container['security_Service'] = static fn (ContainerInterface $container): SecurityService => new SecurityService(
    $container->get('securityRepository')
 );