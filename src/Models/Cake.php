<?php

namespace EcommerceGroup10\Cakery\Models;

use EcommerceGroup10\Cakery\Helpers\Database;
use PDO;

class Cake
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getAllCakes(){
        $sql = "SELECT * FROM Cake";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $cakes = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $cakes;
    }

    public function getCakeById($cakeId)
    {
        $sql = "SELECT * FROM Cake WHERE CakeId = :CakeId";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':CakeId', $cakeId);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
