<?php
namespace EcommerceGroup10\Cakery\Models;

use EcommerceGroup10\Cakery\Helpers\Database;
use PDO;

class Cart
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getItems($customerId){
        $sql = "SELECT * FROM Cart WHERE CustomerId = :CustomerId";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':CustomerId', $customerId);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createItem($customerId, $cakeId, $quantity = 1){
        $sql = "INSERT INTO Cart (CustomerId, CakeId, Quantity) VALUES (:CustomerId, :CakeId, :Quantity)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':CustomerId', $customerId);
        $stmt->bindParam(':CakeId', $cakeId);
        $stmt->bindParam(':Quantity', $quantity);
        return $stmt->execute();
    }

    public function updateQuantity($cartId, $quantity){
        $sql = "UPDATE Cart SET Quantity = :Quantity WHERE CartId = :CartId";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':CartId', $cartId);  
        $stmt->bindParam(':Quantity', $quantity);
        return $stmt->execute();
    }

    public function deleteItem($cartId){
        $sql = "DELETE FROM Cart WHERE CartId = :CartId";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':CartId', $cartId );
        return $stmt->execute();
    }

    public function deleteAllItems($customerId){
        $sql = "DELETE FROM Cart WHERE CustomerId = :CustomerId";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':CustomerId', $customerId);
        return $stmt->execute();
    }
}
