<?php
namespace EcommerceGroup10\Cakery\Controllers;

use EcommerceGroup10\Cakery\Helpers\ViewHelper;
use EcommerceGroup10\Cakery\Models\Cart;
use function EcommerceGroup10\Cakery\Helpers\ViewHelper;

class CartController
{
    private $cart;

    public function __construct()
    {
        $this->cart = new Cart();
    }

    public function addToCart(){
        $errors = $this->validateCartInput($_POST);

        if (empty($errors)) {
        $customerId = $_SESSION["CustomerId"];
        $cakeId = $_POST['CakeId'];
        $quantity = (int) $_POST['Quantity'];
        $result = $this->cart->createItem($customerId, $cakeId, $quantity);
        
        if ($result) {
             $_SESSION['success_message'] = "Cake added to cart";
             exit;
            } else {
                $errors[] = "An error occurred while adding this item to cart. Please try again.";
            }
        }
    }

    public function getCartItems(){
        $customerId = $_SESSION["CustomerId"];
        $cartItems = $this->cart->getItems($customerId);
        return ViewHelper::renderView("cart", ["cartItems" => $cartItems]);
    }

    public function updateItemQuantity(){
        $errors = []; 
        if (empty($_POST['CartId'])){
           $errors[] = "Item not found in cart";
        }

        if (empty($_POST['Quantity']) or (int) $_POST['Quantity'] < 1) {
            $errors[] = "Quantity must be a number greater than zero";
        }

        if (empty($errors)) {
        $cartId = $_POST["CartId"];
        $quantity = (int) $_POST['Quantity'];
        $result = $this->cart->updateQuantity($cartId, $quantity);
        
        if ($result) {
             $_SESSION['success_message'] = "Item added to cart";
            } else {
                $errors[] = "An error occurred while adding this item to cart. Please try again.";
            }
        }

        return ViewHelper::renderView('cart', ['errors' => $errors]);
    }

    public function removeItemFromCart(){
        $errors = []; 
        if (empty($_POST['CartId'])){
           $errors[] = "Item not found in cart";
        }
        
        if (empty($errors)) {
            $result = $this->cart->deleteItem($_POST['CartId']);
            if ($result) {
                $_SESSION['success_message'] = "Item removed from cart";
            } else {
                $errors[] = "An error occurred while removing this item from cart. Please try again.";
            }
        }
        return ViewHelper::renderView('cart', ['errors' => $errors]);
    }
    
    public function clearCart(){
        $errors = [];
        $customerId = $_SESSION["CustomerId"];
        $result = $this->cart->deleteAllItems($customerId);
            if ($result) {
                $_SESSION['success_message'] = "Item removed from cart";
            } else {
                $errors[] = "An error occurred while removing this item from cart. Please try again.";
            }

        return ViewHelper::renderView('cart', ['errors' => $errors]);
    }

    
    private function validateCartInput($data)
    {
        $errors = [];

        if (empty($data['CakeId'])) {
            $errors[] = "Cake not found";
        }

        if (!empty($data['Quantity']) and (int) $data['Quantity'] < 1) {
            $errors[] = "Quantity can not be less than one";
        }

        return $errors;
    }

}
