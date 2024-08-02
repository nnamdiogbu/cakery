<?php

define('APP_ROOT', dirname(__DIR__));

require_once APP_ROOT . '/vendor/autoload.php';

$config = require APP_ROOT . '/config/config.php';
$dbConfig = $config['db'];

session_start();

use EcommerceGroup10\Cakery\Helpers\Database;
use EcommerceGroup10\Cakery\Helpers\DatabaseInitializer;
use EcommerceGroup10\Cakery\Controllers\HomeController;
use EcommerceGroup10\Cakery\Controllers\AuthController;
Database::init($dbConfig);

$initializer = new DatabaseInitializer();
$initializer->initializeDatabase();

$request = $_SERVER['REQUEST_URI'];

if (false !== $pos = strpos($request, '?')) {
    $request = substr($request, 0, $pos);
}

$request = str_replace('/cakery', '', $request);

switch ($request) {
    case '':
    case '/':
        $controller = new HomeController();
        echo $controller->index();
        break;
    case '/login':
        $controller = new AuthController();
        echo $controller->login();
        break;
    case '/register':
        $controller = new AuthController();
        echo $controller->register();
        break;
    case '/logout':
        $controller = new AuthController();
        $controller->logout();
        break;
    default:
        http_response_code(404);
        echo '404 - Page Not Found';
        break;
}
