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
        return ViewHelper::renderView("home");
    }
    public function getCakes()
    {
        $cakes = $this->cake->getAllCakes();
        return ViewHelper::renderView("cake", ['cakes' => $cakes]);
    }

    public function cakeDetails($id)
    {
        $cake = $this->cake->getCakeById($id);
        return ViewHelper::renderView("cake-details", ['cake' => $cake]);
    }
}
