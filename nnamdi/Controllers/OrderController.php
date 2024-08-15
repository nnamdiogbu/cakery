<?php

namespace EcommerceGroup10\Cakery\Controllers;


use EcommerceGroup10\Cakery\Helpers\ViewHelper;
use EcommerceGroup10\Cakery\Models\Orders;
use EcommerceGroup10\Cakery\Models\Cake;

use PDOException;

class OrderController
{
    private $order;
    private $cake;
    private $taxRate;

    public function __construct()
    {
        $this->order = new Orders();
        $this->cake = new Cake();
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
        $total = $subTotal * $taxRate;

        return ViewHelper::renderView("checkout", [
            'subTotal' => $subTotal,
            'taxRate' => $taxRate,
            'total' => $total
        ]);
    }
    //function not complete & not tested
    public function createOrder()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $customerId = $_SESSION['CustomerId'];

            $orderDetails = $_POST['orderDetails'] ?? [];

            if (empty($orderDetails)) {
                echo "Invalid order details.";
                return;
            }

            $totalAmount = 0;

            $preparedOrderDetails = [];
            foreach ($orderDetails as $detail) {
                if (isset($detail['CakeId']) && isset($detail['Quantity'])) {
                    $cakeId = (int)$detail['CakeId'];
                    $quantity = (int)$detail['Quantity'];

                    $cake = $this->cake->getCakeById($cakeId);
                    if ($cake) {
                        $price = $cake['Price'];
                        $totalAmount += $price * $quantity * $this->taxRate;

                        $preparedOrderDetails[] = [
                            'CakeId' => $cakeId,
                            'Quantity' => $quantity
                        ];
                    }
                }
            }

            if (empty($preparedOrderDetails)) {
                echo "No valid order details provided.";
                return;
            }

            try {
                $orderId = $this->order->createOrder($customerId, $totalAmount * $this->taxRate, $preparedOrderDetails);
                $order = $this->order->getOrderById($orderId); 
                return ViewHelper::renderView("orderConfirmation", ['order' => $order ]); 
            } catch (PDOException $e) {
                echo "Failed to create order: " . $e->getMessage();
            }
        }
    }
}
