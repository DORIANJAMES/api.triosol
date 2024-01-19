<?php

class App
{
    protected static $currentPath;
    protected static $currentMethod;
    protected static $home;
    protected static $routes = [];

    public static $returnArray;

    public function __construct($config)
    {
        self::$currentPath = $_SERVER['REQUEST_URI'];
        self::$currentMethod = $_SERVER['REQUEST_METHOD'];
        self::$home = $config['home'];
        self::$returnArray = $config['returnArray'];
        self::startRoute();;
    }

    public static function getAction($link, $path, $auth = false)
    {
        self::$routes[] = [
            'GET',
            $link,
            $path,
            $auth,
        ];
    }

    public static function postAction($link, $path, $auth = false)
    {
        self::$routes[] = [
            'POST',
            $link,
            $path,
            $auth,
        ];
    }

    public static function startRoute()
    {

        foreach (self::$routes as $route) {
            list($method, $link, $path, $auth) = $route;

            if (self::$currentPath == '/') self::$currentPath = $path;

            $methodCheck = self::$currentMethod == $method;
            $pathCheck = preg_match('@^' . $link . '$@', self::$currentPath, $params);

            $module = "";
            $method = "";
            $controller = "";

            if ($methodCheck && $pathCheck) {
                $uri = explode('/', $path);
                array_shift($uri);

                @list($activeModule, $activeMethod) = $uri;

                if (self::$currentPath == "/" || self::$currentPath == "" || self::$currentPath == "/index") {
                    $module = self::$home['module'];
                    $controller = self::$home['module'] . "Controller";
                    $method = self::$home['method'];
                } else {
                    // TODO : Auth işlemleri
                    $module = $activeModule;
                    $controller = $activeModule . "Controller";
                    $method = $activeMethod;
                }

                $file = DIRECTORY . "/Modules/" . $module . "/controller/" . $controller . ".php";

                if (file_exists($file)) {
                    require_once $file;

                    if (class_exists($controller)) {
                        $class = new $controller(self::$returnArray);
                        if (method_exists($class, $method)) {
                            array_shift($params);
                            return call_user_func_array([$class, $method], array_values($params));
                        } else {
                            echo json_encode(self::$returnArray['message'] = "404 - Method Not Found");
                        }
                    } else {
                        echo json_encode(self::$returnArray['message'] = "404 - Class Not Found");
                    }
                } else {
                    echo json_encode(self::$returnArray['message'] = "404 - controller Not Found");
                }
            }
        }
        echo json_encode(self::$returnArray['message'] = "404 - Page Not Found");
    }
}