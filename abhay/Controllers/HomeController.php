<?php

namespace EcommerceGroup10\Cakery\Controllers;

use EcommerceGroup10\Cakery\Helpers\ViewHelper;
use EcommerceGroup10\Cakery\Models\Cake;

class HomeController
{
    private $cake;
    public function __construct()
    {
       $this->cake = new Cake(); 
    }
    public function index()
    {
        $cakes = $this->cake->getAllCakes();
        return ViewHelper::renderView("home", ['cakes' => $cakes]);
    }
}
