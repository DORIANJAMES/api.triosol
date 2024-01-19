<?php
class mainController {


    public static function callView($module, $method, $params=[]) {
        return View::frontView($module, $method, $params);
    }
}