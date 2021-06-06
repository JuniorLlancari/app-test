<?php

declare(strict_types=1);

$baseDir = __DIR__ . '/../../';
$dotenv = Dotenv\Dotenv::createImmutable($baseDir);
$envFile = $baseDir . '.env';
if (file_exists($envFile)) {
    $dotenv->load();
}


// $dotenv->required(['DB_HOST', 'DB_NAME', 'DB_USER', 'DB_PASS']);
// $settings = require __DIR__ . '/Settings.php'; 

$app = new \Slim\App();
$container = $app->getContainer();

use Psr\Container\ContainerInterface;
use Src\Infrastructure\Services\EmpleadoService;
use Src\Infrastructure\Services\SecurityService;

$container['security_service'] = new SecurityService;
$container['empleadoService'] = new EmpleadoService;


// require __DIR__ . '/Services.php';
require __DIR__ . '/Routes.php';
$app->run();
