<?php
class View
{
    public static function frontView($module, $method, $data = null)
    {

        if (file_exists($file = DIRECTORY . "/Modules/{$module}/view/{$method}View.php")) {
            require_once $file;
        } else {
            die("{$module}/view/{$method}View.php dosyası bulunamadı.");
        }
    }
}