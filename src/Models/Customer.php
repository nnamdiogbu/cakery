<?php

namespace EcommerceGroup10\Cakery\Models;

use EcommerceGroup10\Cakery\Helpers\Database;
use PDO;

class Customer
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function create($data)
    {
        $sql = "INSERT INTO Customer (CustomerName, Email, PhoneNumber, Password) VALUES (:CustomerName, :Email, :PhoneNumber, :Password)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':CustomerName', $data['CustomerName']);
        $stmt->bindParam(':Email', $data['Email']);
        $stmt->bindParam(':PhoneNumber', $data['PhoneNumber']);
        $password = password_hash($data['Password'], PASSWORD_DEFAULT);
        $stmt->bindParam(':Password', $password);
        return $stmt->execute();
    }

    public function getCustomerByEmail($email)
    {
        $sql = "SELECT * FROM Customer WHERE Email = :Email";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':Email', $email);
        $stmt->execute();
        $customer = $stmt->fetch(PDO::FETCH_ASSOC);

        return $customer;
    }

    public function authenticate($email, $password)
    {
        $customer = this->getCustomerByEmail($email);

        if ($customer && password_verify($password, $customer['Password'])) {
            return $customer;
        }
        return false;
    }
}
