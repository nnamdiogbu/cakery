<?php

define('APP_ROOT', dirname(__DIR__));

$config = require APP_ROOT . '/nnamdi/config/config.php';
$appConfig = $config['app'];
$dbConfig = $config['db'];

define('CSS_URL', $appConfig['url'] . '/bhunmi/css/');

session_start();
require_once(APP_ROOT . "/sunny/Helpers/Database.php");
require_once(APP_ROOT . "/sunny/Helpers/DatabaseInitializer.php");
require_once(APP_ROOT . "/sunny/Models/Cake.php");
require_once(APP_ROOT . "/sunny/Models/Orders.php");
require_once(APP_ROOT . "/sunny/Models/Customer.php");
require_once(APP_ROOT . "/sunny/Models/Cart.php");
require_once(APP_ROOT . "/abhay/Controllers/HomeController.php");
require_once(APP_ROOT . "/abhay/Controllers/AuthController.php");
require_once(APP_ROOT . "/abhay/Controllers/CartController.php");
require_once(APP_ROOT . "/nnamdi/Controllers/OrderController.php");
require_once(APP_ROOT . "/nnamdi/Helpers/ViewHelper.php");

use EcommerceGroup10\Cakery\Controllers\CartController;
use EcommerceGroup10\Cakery\Controllers\OrderController;
use EcommerceGroup10\Cakery\Helpers\DatabaseInitializer;
use EcommerceGroup10\Cakery\Controllers\HomeController;
use EcommerceGroup10\Cakery\Controllers\AuthController;
use EcommerceGroup10\Cakery\Helpers\Database;

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
    case '/cake':
        $controller = new HomeController();
        echo $controller->getCakes();
        break;
    case '/cake-details':
        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
        $controller = new HomeController();
        echo $controller->cakeDetails($id);
        break;
    case '/logout':
        $controller = new AuthController();
        echo $controller->logout();
        break;
    case '/orders':
        $controller = new OrderController();
        echo $controller->orders();
        break;
    case '/checkout':
        $controller = new OrderController();
        echo $controller->checkout();
        break;
    case '/create-order':
        $controller = new OrderController();
        echo $controller->createOrder();
        break;
    case '/cart':
        $controller = new CartController();
        echo $controller->getCartItems();
        break;
    case '/add-to-cart':
        $controller = new CartController();
        echo $controller->addToCart();
        break;
    case '/update-cart-item':
        $controller = new CartController();
        echo $controller->updateItemQuantity();
        break;
    case '/remove-cart-item':
        $controller = new CartController();
        echo $controller->removeItemFromCart();
        break;
    case '/clear-cart':
        $controller = new CartController();
        echo $controller->clearCart();
        break;
    default:
        http_response_code(404);
        echo '404 - Page Not Found';
        break;
}
