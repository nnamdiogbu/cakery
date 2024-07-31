<!DOCTYPE html>
<html>

<head>
    <title>Initialize Database</title>
</head>

<body>

    <?php
    require_once 'dbconn.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        try {
            $database = new Database();
            $db = $database->getConnection();

            $sql = "CREATE DATABASE IF NOT EXISTS ecommerce_group_10";
            $db->exec($sql);

            $sql = "CREATE TABLE IF NOT EXISTS Customer (
            CustomerId INT AUTO_INCREMENT PRIMARY KEY,
            CustomerName VARCHAR(255) NOT NULL,
            Email VARCHAR(255) NOT NULL UNIQUE,
            PhoneNumber VARCHAR(20),
            password VARCHAR(255) NOT NULL
        )";
            $db->exec($sql);

            $sql = "CREATE TABLE IF NOT EXISTS `Order` (
            OrderId INT AUTO_INCREMENT PRIMARY KEY,
            CustomerId INT NOT NULL,
            OrderDate DATE NOT NULL,
            TotalAmount DECIMAL(10, 2) NOT NULL,
            FOREIGN KEY (CustomerId) REFERENCES Customer(CustomerId)
        )";
            $db->exec($sql);

            $sql = "CREATE TABLE IF NOT EXISTS Cake (
            CakeId INT AUTO_INCREMENT PRIMARY KEY,
            CakeName VARCHAR(255) NOT NULL,
            Price DECIMAL(10, 2) NOT NULL
        )";
            $db->exec($sql);

            $sql = "CREATE TABLE IF NOT EXISTS OrderDetails (
            OrderDetailId INT AUTO_INCREMENT PRIMARY KEY,
            OrderId INT NOT NULL,
            CakeId INT NOT NULL,
            Quantity INT NOT NULL,
            FOREIGN KEY (OrderId) REFERENCES `Order`(OrderId),
            FOREIGN KEY (CakeId) REFERENCES Cake(CakeId)
        )";
            $db->exec($sql);

            echo "Database tables created successfully.";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    ?>

    <form method="post">
        <button type="submit">Initialize Database</button>
    </form>

</body>

</html>