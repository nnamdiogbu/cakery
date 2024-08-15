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

            return ViewHelper::renderCustomView('abhay', 'register', ['errors' => $errors]);
        }

        return ViewHelper::renderCustomView('abhay', 'register');
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $errors = $this->validateLoginInput($_POST);

            if (!empty($errors)) {
                return ViewHelper::renderView('login', ['errors' => $errors]);
            }

            $email = $_POST['Email'];
            $password = $_POST['Password'];

            $customer = $this->customer->authenticate($email, $password);


            if ($customer) {
                session_start();
                $_SESSION['CustomerId'] = $customer['CustomerId'];
                $_SESSION['CustomerName'] = $customer['CustomerName'];
                $_SESSION['Email'] = $customer['Email'];

                header("Location: /cakery");
                exit;
            } else {
                $errors[] = "Invalid email or password.";
                return ViewHelper::renderCustomView('abhay', 'login', ['errors' => $errors]);
            }
        }

        return ViewHelper::renderCustomView('abhay', 'login');
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
        } elseif (!preg_match('/^\d{10}$/', $data['PhoneNumber'])) {
            $errors[] = "Phone number must be a 10-digit number.";
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

    private function validateLoginInput($data)
    {

        $errors = [];

        if (empty($data['Email'])) {
            $errors[] = "Email is required.";
        } elseif (!filter_var($data['Email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Invalid email format.";
        }


        if (empty($data['Password'])) {
            $errors[] = "Password is required.";
        } elseif (strlen($data['Password']) < 8) {
            $errors[] = "Password must be at least 8 characters long.";
        }

        return $errors;
    }
}
