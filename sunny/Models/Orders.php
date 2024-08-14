<?php

namespace EcommerceGroup10\Cakery\Models;

use EcommerceGroup10\Cakery\Helpers\Database;
use PDO;
use PDOException;

class Orders
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }


    public function createOrder($customerId, $totalAmount, $orderDetails)
    {
        try {
            $this->db->beginTransaction();

            $sql = "INSERT INTO `Order` (CustomerId, TotalAmount) VALUES (:CustomerId, :TotalAmount)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':CustomerId', $customerId);
            $stmt->bindParam(':TotalAmount', $totalAmount);
            $stmt->execute();
            $orderId = $this->db->lastInsertId();

            foreach ($orderDetails as $detail) {
                $sql = "INSERT INTO OrderDetails (OrderId, CakeId, Quantity) VALUES (:OrderId, :CakeId, :Quantity)";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(':OrderId', $orderId);
                $stmt->bindParam(':CakeId', $detail['CakeId']);
                $stmt->bindParam(':Quantity', $detail['Quantity']);
                $stmt->execute();
            }

            $this->db->commit();
            return $orderId;
        } catch (PDOException $e) {
            $this->db->rollBack();
            echo "Error occured while attempting to create this order: " . $e->getMessage() . "\n";
        }
    }

    public function getOrdersByCustomerId($customerId)
    {
        $sql = "
            SELECT o.OrderId, o.OrderDate, o.TotalAmount, od.OrderDetailId, od.CakeId, od.Quantity, c.CakeName, c.Price
            FROM `Order` o
            JOIN OrderDetails od ON o.OrderId = od.OrderId
            JOIN Cake c ON od.CakeId = c.CakeId
            WHERE o.CustomerId = :CustomerId
        ";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':CustomerId', $customerId);
        $stmt->execute();
        $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $result = [];
        foreach ($orders as $order) {
            $orderId = $order['OrderId'];
            if (!isset($result[$orderId])) {
                $result[$orderId] = [
                    'OrderId' => $orderId,
                    'OrderDate' => $order['OrderDate'],
                    'TotalAmount' => $order['TotalAmount'],
                    'OrderDetails' => []
                ];
            }
            $result[$orderId]['OrderDetails'][] = [
                'OrderDetailId' => $order['OrderDetailId'],
                'CakeId' => $order['CakeId'],
                'CakeName' => $order['CakeName'],
                'Price' => $order['Price'],
                'Quantity' => $order['Quantity']
            ];
        }

        return array_values($result);
    }

    public function getOrderById($orderId)
    {
        $sql = "
            SELECT o.OrderId, o.OrderDate, o.TotalAmount, od.OrderDetailId, od.CakeId, od.Quantity, c.CakeName, c.Price
            FROM `Order` o
            JOIN OrderDetails od ON o.OrderId = od.OrderId
            JOIN Cake c ON od.CakeId = c.CakeId
            WHERE o.OrderId = :OrderId
        ";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':OrderId', $orderId);
        $stmt->execute();
        $orderDetails = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!$orderDetails) {
            return null;
        }

        $result = [
            'OrderId' => $orderDetails[0]['OrderId'],
            'OrderDate' => $orderDetails[0]['OrderDate'],
            'TotalAmount' => $orderDetails[0]['TotalAmount'],
            'OrderDetails' => []
        ];

        foreach ($orderDetails as $detail) {
            $result['OrderDetails'][] = [
                'OrderDetailId' => $detail['OrderDetailId'],
                'CakeId' => $detail['CakeId'],
                'CakeName' => $detail['CakeName'],
                'Price' => $detail['Price'],
                'Quantity' => $detail['Quantity']
            ];
        }

        return $result;
    }

}

