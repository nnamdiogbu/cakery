<?php
namespace EcommerceGroup10\Cakery\Helpers;

class ViewHelper
{
    private static $defaultViewRoot = "bhumi";

    public static function renderView($view, $data = [], $viewRoot = null)
    {
        $viewRoot = $viewRoot ?? self::$defaultViewRoot;
        extract($data);
        ob_start();
        $viewPath = APP_ROOT . "/{$viewRoot}/Views/{$view}.php";
        if (!file_exists($viewPath)) {
            throw new \Exception("View file not found: {$viewPath}");
        }
        include $viewPath;
        return ob_get_clean();
    }

    public static function renderCustomView($viewRoot, $view, $data = [])
    {
        return self::renderView($view, $data, $viewRoot);
    }
}

