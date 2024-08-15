<?php

namespace EcommerceGroup10\Cakery\Controllers;


use EcommerceGroup10\Cakery\Helpers\ViewHelper;
use EcommerceGroup10\Cakery\Models\Cart;
use EcommerceGroup10\Cakery\Models\Orders;
use EcommerceGroup10\Cakery\Models\Cake;

use PDOException;

class OrderController
{
    private $order;
    private $cake;
    private $cart;
    private $taxRate;

    public function __construct()
    {
        $this->order = new Orders();
        $this->cake = new Cake();
        $this->cart = new Cart();
        $this->taxRate = 0.13;
    }

    public function orders()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $customerId = $_SESSION['CustomerId'];
            $orders = $this->order->getOrdersByCustomerId($customerId);
            return ViewHelper::renderView('orders', ['orders' => $orders]);
        }
    }

    public function checkout()
    {
        $subTotal = $_GET['subtotal'] ?? 0;
        $taxRate = $this->taxRate;
        $tax = $subTotal * $taxRate;
        $total = $subTotal + $tax;

        return ViewHelper::renderView("checkout", [
            'subTotal' => $subTotal,
            'taxRate' => $taxRate,
            'total' => $total
        ]);
    }
    public function createOrder()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $errors = $this->checkoutInputValidation($_POST);
            $_subTotal = $_POST['subTotal'];
            $_taxRate = $_POST['taxRate'];
            $_total = $_POST['total'];
            if (!empty($errors))
            {
                return ViewHelper::renderView("checkout", [
                    'errors' => $errors,
                    'subTotal' => $_subTotal,
                    'taxRate' => $_taxRate,
                    'total' => $_total
                ]);
            } 

            $customerId = $_SESSION['CustomerId'];

            $cartItems = $this->cart->getItems($customerId);


            if (empty($cartItems)) {
                $errors[] = "Unable to create order, please try again later";
                return ViewHelper::renderView("checkout", [
                    'errors' => $errors,
                    'subTotal' => $_subTotal,
                    'taxRate' => $_taxRate,
                    'total' => $_total
                ]);
            }

            $subTotal = 0;
    
            $preparedOrderDetails = [];

            foreach ($cartItems as $item){
                $subTotal +=  $item['Price'] * $item['Quantity'];
                $preparedOrderDetails[] = [
                    'CakeId' => $item['CakeId'],
                    'Quantity' => $item['Quantity']
                ];
            }

            if (empty($preparedOrderDetails)) {
                $errors[] = "Unable to create order, please try again later";
                return ViewHelper::renderView("checkout", [
                    'errors' => $errors,
                    'subTotal' => $_subTotal,
                    'taxRate' => $_taxRate,
                    'total' => $_total
                ]);
            }

            try {
                $tax = $subTotal * $this->taxRate;
                $total = $subTotal + $tax;
                $orderId = $this->order->createOrder($customerId, $total, $preparedOrderDetails);
                $order = $this->order->getOrderById($orderId); 
                return ViewHelper::renderView("order-confirmation", ['order' => $order ]); 
            } catch (PDOException $e) {
                echo "Failed to create order: " . $e->getMessage();
            }
        }
    }

    private function checkoutInputValidation($data){
    $errors = [];
    $name = $address = $city = $zip = $cardNumber = $expiryDate = $cvv = '';

    $name = trim($data['name']);
    $address = trim($data['address']);
    $city = trim($data['city']);
    $zip = trim($data['zip']);
    $cardNumber = trim($data['cardNumber']);
    $expiryDate = trim($data['expiryDate']);
    $cvv = trim($data['cvv']);

    if (empty($name)) $errors['name'] = 'Name is required';
    if (empty($address)) $errors['address'] = 'Address is required';
    if (empty($city)) $errors['city'] = 'City is required';
    if (empty($zip) || !preg_match('/^[A-Za-z]\d[A-Za-z] \d[A-Za-z]\d$/', $zip)) $errors['zip'] = 'Valid Canadian Postal Code is required';
    if (empty($cardNumber) || !preg_match('/^\d{16}$/', $cardNumber)) $errors['cardNumber'] = 'Valid Card Number is required';
    if (empty($expiryDate) || !preg_match('/^\d{2}\/\d{2}$/', $expiryDate)) $errors['expiryDate'] = 'Valid Expiry Date (MM/YY) is required';
    if (empty($cvv) || !preg_match('/^\d{3}$/', $cvv)) $errors['cvv'] = 'Valid CVV is required';

    return $errors;
    }
}
