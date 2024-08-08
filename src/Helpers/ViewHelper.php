<?php
namespace EcommerceGroup10\Cakery\Helpers;

class ViewHelper
{
    public static function renderView($view, $data = [])
    {
        extract($data);
        ob_start();
        $viewPath = APP_ROOT . "/src/Views/{$view}.php";
        if (!file_exists($viewPath)) {
            throw new \Exception("View file not found: {$viewPath}");
        }
        include $viewPath;
        return ob_get_clean();
    }
}
