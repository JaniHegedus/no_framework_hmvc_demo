<?php

require_once 'application/config/config.php';

// Load core classes
foreach (glob('system/core/*.php') as $core) {
    require_once $core;
}
// Load libs
foreach (glob('system/libraries/*.php') as $libraries) {
    require_once $libraries;
}

// Routing
$url = isset($_GET['url']) ? $_GET['url'] : 'home';
$url = rtrim($url, '/');
$url = explode('/', $url);

$module = $url[0];
$controllerName = ucfirst($module) . 'Controller';
$methodName = isset($url[1]) ? $url[1] : 'index';
$params = array_slice($url, 2);

// Check if the controller exists in the main application controllers
if (file_exists("application/controllers/$controllerName.php")) {
    require_once "application/controllers/$controllerName.php";
    $controller = new $controllerName;
} else {
    // Check if the controller exists in the module
    $moduleControllerPath = "application/modules/$module/controllers/$controllerName.php";
    if (file_exists($moduleControllerPath)) {
        require_once $moduleControllerPath;
        $controller = new $controllerName($module); // Pass the module name to the controller
    } else {
        die("Controller $controllerName not found!");
    }
}
$requestMethod = $_SERVER['REQUEST_METHOD'];
// Adjust method name for POST requests based on the button name
if ($requestMethod === 'POST') {
    foreach ($_POST as $key => $value) {
        if (method_exists($controller, $key)) {
            $methodName = $key;
            break;
        }
    }
}
if (method_exists($controller, $methodName)) {
    call_user_func_array([$controller, $methodName], $params);
} else {
    die("Method $methodName not found!");
}
