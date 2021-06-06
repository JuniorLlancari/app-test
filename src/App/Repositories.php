<?php

declare(strict_types=1);
use Psr\Container\ContainerInterface;
use Src\Infrastructure\Data\DbContext;
use Src\Infrastructure\Repositories\EmpleadoRepository;
use Src\Infrastructure\Repositories\SecurityRepository;

 

$container['empleadoRepository'] = static fn (ContainerInterface $container): EmpleadoRepository => new EmpleadoRepository(DbContext::get());

$container['securityRepository'] = static fn (ContainerInterface $container): SecurityRepository => new SecurityRepository(DbContext::get());

 

    // $container['empleadoRepository'] = static fn (ContainerInterface $container): EmpleadoRepository => new EmpleadoRepository($container->get('db'));
