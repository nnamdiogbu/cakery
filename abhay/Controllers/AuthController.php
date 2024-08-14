<?php

namespace EcommerceGroup10\Cakery\Controllers;

use EcommerceGroup10\Cakery\Helpers\ViewHelper;
use EcommerceGroup10\Cakery\Models\Customer;
use function EcommerceGroup10\Cakery\Helpers\ViewHelper;

class AuthController
{
    private $customer;

    public function __construct()
    {
        $this->customer = new Customer();
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $errors = $this->validateRegistrationInput($_POST);

            if (empty($errors)) {
                $result = $this->customer->create([
                    'CustomerName' => $_POST['CustomerName'],
                    'Email' => $_POST['Email'],
                    'PhoneNumber' => $_POST['PhoneNumber'],
                    'Password' => $_POST['Password']
                ]);

                if ($result) {
                    $_SESSION['success_message'] = "Registration successful. Please log in.";
                    header("Location: /cakery/login");
                    exit;
                } else {
                    $errors[] = "An error occurred during registration. Please try again.";
                }
            }

            return ViewHelper::renderView('register', ['errors' => $errors]);
        }

        return ViewHelper::renderView('register');
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['Email'] ?? '';
            $password = $_POST['Password'] ?? '';

            $customer = $this->customer->authenticate($email, $password);
            

            if ($customer) {
                session_start();
                $_SESSION['CustomerId'] = $customer['CustomerId'];
                $_SESSION['CustomerName'] = $customer['CustomerName'];
                $_SESSION['Email'] = $customer['Email'];

                header("Location: /cakery");
                exit;
            } else {
                $error = "Invalid email or password.";
                return ViewHelper::renderView('login', ['error' => $error]);
            }
        }

        return ViewHelper::renderView('login');
    }

    public function logout()
    {
        $_SESSION = [];
        session_destroy();
        header("Location: /cakery");
        exit;
    }

    private function validateRegistrationInput($data)
    {
        $errors = [];

        if (empty($data['CustomerName'])) {
            $errors[] = "Name is required.";
        }

        if (empty($data['Email'])) {
            $errors[] = "Email is required.";
        } elseif (!filter_var($data['Email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Invalid email format.";
        }

        if (empty($data['PhoneNumber'])) {
            $errors[] = "Phone number is required.";
        }

        if (empty($data['Password'])) {
            $errors[] = "Password is required.";
        } elseif (strlen($data['Password']) < 8) {
            $errors[] = "Password must be at least 8 characters long.";
        }

        if ($data['Password'] !== $data['ConfirmPassword']) {
            $errors[] = "Passwords do not match.";
        }

        return $errors;
    }

}
