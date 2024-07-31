<?php
require_once '../../db/dbconn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    try {
        $database = new Database();
        $db = $database->getConnection();

        $sql = "INSERT INTO Customer (CustomerName, Email, PhoneNumber, password) VALUES (:name, :email, :phone, :password)";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':password', $password);

        if ($stmt->execute()) {
            echo "Registration successful. <a href='../../pages/login.php'>Login here</a>";
        } else {
            echo "Error: Could not execute the query.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
