<?php

declare(strict_types=1);


use Psr\Container\ContainerInterface;
use Src\Infrastructure\Services\EmpleadoService;
use Src\Infrastructure\Services\SecurityService;


$container['security_service'] = new SecurityService;
$container['empleadoService'] = new EmpleadoService;


