<?php

namespace EcommerceGroup10\Cakery\Helpers;

class ViewHelper
{
    private $viewRoot = "bhumi";
    public static function renderView($view, $data = [])
    {
        extract($data);
        ob_start();
        $viewPath = APP_ROOT . "/{$this->viewRoot}/Views/{$view}.php";
        if (!file_exists($viewPath)) {
            throw new \Exception("View file not found: {$viewPath}");
        }
        include $viewPath;
        return ob_get_clean();
    }
    
    public static function renderCustomView($viewRoot, $view, $data){
        $this->viewRoot = $viewRoot;
        return $this->renderView($view, $data);
    }
}

