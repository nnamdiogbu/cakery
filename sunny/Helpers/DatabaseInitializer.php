<?php

namespace EcommerceGroup10\Cakery\Helpers;

use PDOException;

class DatabaseInitializer
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function initializeDatabase()
    {
        if ($this->isDatabaseInitialized()) {
            return;
        }

        try {
            $this->createMigrationHistoryTable();
            $this->createCustomerTable();
            $this->createOrderTable();
            $this->createCakeTable();
            $this->createOrderDetailsTable();

            $this->recordMigration('initialization');
            
        } catch (PDOException $e) {
            echo "Error creating tables: " . $e->getMessage() . "\n";
        }
    }

    private function createMigrationHistoryTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS MigrationHistory (
            MigrationId INT AUTO_INCREMENT PRIMARY KEY,
            MigrationName VARCHAR(255) NOT NULL,
            MigrationDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";
        $this->db->exec($sql);
    }

    private function createCustomerTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS Customer (
            CustomerId INT AUTO_INCREMENT PRIMARY KEY,
            CustomerName VARCHAR(255) NOT NULL,
            Email VARCHAR(255) NOT NULL UNIQUE,
            PhoneNumber VARCHAR(20),
            Password VARCHAR(255) NOT NULL
        )";
        $this->db->exec($sql);
    }

    private function createOrderTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS `Order` (
            OrderId INT AUTO_INCREMENT PRIMARY KEY,
            CustomerId INT NOT NULL,
            OrderDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP, 
            TotalAmount DECIMAL(10, 2) NOT NULL,
            FOREIGN KEY (CustomerId) REFERENCES Customer(CustomerId)
        )";
        $this->db->exec($sql);
    }

    private function createCakeTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS Cake (
            CakeId INT AUTO_INCREMENT PRIMARY KEY,
            CakeName VARCHAR(255) NOT NULL,
            Price DECIMAL(10, 2) NOT NULL,
            CakeImage VARCHAR(255) NOT NULL,
            Featured TINYINT(1) DEFAULT 0
        )";
        $this->db->exec($sql);
    }

    private function createOrderDetailsTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS OrderDetails (
            OrderDetailId INT AUTO_INCREMENT PRIMARY KEY,
            OrderId INT NOT NULL,
            CakeId INT NOT NULL,
            Quantity INT NOT NULL,
            FOREIGN KEY (OrderId) REFERENCES `Order`(OrderId),
            FOREIGN KEY (CakeId) REFERENCES Cake(CakeId)
        )";
        $this->db->exec($sql);
    }

    private function createCartTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS Cart (
                CartId INT AUTO_INCREMENT PRIMARY KEY,
                CustomerId INT NOT NULL,
                CakeId INT NOT NULL,
                Quantity INT NOT NULL,
                FOREIGN KEY (CakeID) REFERENCES Cake(CakeId), 
                FOREIGN KEY (CustomerId) REFERENCES Customer(CustomerId) 
            )";
        $this->db->exec($sql);
    }

    private function isDatabaseInitialized()
    {
        try {
            $sql = "SELECT (1) FROM MigrationHistory WHERE MigrationName = 'initialization'";
            $stmt = $this->db->query($sql);
            return $stmt->fetchColumn() > 0;
        } catch (PDOException $e) {
            return false;
        }
    }

    private function recordMigration($migrationName)
    {
        $sql = "INSERT INTO MigrationHistory (MigrationName) VALUES (:migrationName)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':migrationName', $migrationName);
        $stmt->execute();
    }
}

