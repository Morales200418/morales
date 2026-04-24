<?php

date_default_timezone_set('Asia/Manila');

spl_autoload_register(function ($class){
    $paths = [
        __DIR__ . '/../app/core/' . $class. '.php',
        __DIR__ . '/../app/models/' . $class. '.php',
        __DIR__ . '/../app/controller/' . $class. '.php'
    ];

    foreach($paths as $file){
        if(file_exists($file)){
            require_once $file;
            return;
        }
    }
});

//load session
require_once __DIR__. '/../app/core/Session.php';
//Session::start();

//load routes
$routes = require __DIR__ . '/../app/config/routes.php';

//parse url
$url = $_GET['url'] ?? '/';
$url = '/'. trim($url, '/');

if(str_starts_with($url, '/public')){
    $url = substr($url, 7);
}

//match routes
if(!isset($routes[$url])){
    http_response_code(404);
    require __DIR__ . '/../app/views/error/404.php';
    exit;
}

//get controller and method from route
$route = explode('@', $routes[$url]);
$controllerName = $route[0] . 'Controller';
$methodName = $route[1] ?? 'index';

//call controller method
if(!class_exists($controllerName)){
    http_response_code(500);
    echo "<h1>Error: Controller {$controllerName} not found</h1>";
}

$controller = new $controllerName();
if(!method_exists($controller, $methodName)){
    http_response_code(500);
    echo "<h1>Error: Method {$methodName} not found in controller {$controllerName}</h1>";
    exit;
}

$controller->$methodName();
