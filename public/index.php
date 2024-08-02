<?php

define('APP_ROOT', dirname(__DIR__));

require_once APP_ROOT . '/vendor/autoload.php';

$config = require APP_ROOT . '/config/config.php';

session_start();

use Cakery\Helpers\Database;
$db = Database::getInstance()->getConnection();

$request = $_SERVER['REQUEST_URI'];

if (false !== $pos = strpos($request, '?')) {
    $request = substr($request, 0, $pos);
}

$request = str_replace('/cakery', '', $request);

switch ($request) {
    case '':
    //case '/':
     //   $controller = new Cakery\Controllers\HomeController();
       // echo $controller->index();
        //break;
    case '/login':
        $controller = new Cakery\Controllers\AuthController();
        echo $controller->login();
        break;
    case '/register':
        $controller = new Cakery\Controllers\AuthController();
        echo $controller->register();
        break;
    case '/logout':
        $controller = new Cakery\Controllers\AuthController();
        $controller->logout();
        break;
    default:
        http_response_code(404);
        echo '404 - Page Not Found';
        break;
}
