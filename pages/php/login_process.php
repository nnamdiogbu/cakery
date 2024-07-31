<?php
require_once '../../db/dbconn.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    try {
        $database = new Database();
        $db = $database->getConnection();

        $sql = "SELECT * FROM Customer WHERE Email = :email";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $customer = $stmt->fetch(PDO::FETCH_ASSOC);
            if (password_verify($password, $customer['password'])) {
                $_SESSION['customer_id'] = $customer['CustomerId'];
                $_SESSION['customer_name'] = $customer['CustomerName'];
                header("Location: ../../HomePage.php");
                exit;
            } else {
                echo "Invalid password.";
            }
        } else {
            echo "No user found with that email.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
