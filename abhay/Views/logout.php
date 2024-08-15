<?php
session_start();

if (isset($_SESSION['customer_name'])) {
    unset($_SESSION['customer_name']);
}

$_SESSION = array();

session_destroy();
header('Location: /cakery/login');
exit;
