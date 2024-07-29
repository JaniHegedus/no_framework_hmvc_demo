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

$errorControllerName = 'ErrorController';
$errorMethodName = 'notFound';

function handleError($message) {
    global $errorControllerName, $errorMethodName;
    if (file_exists("application/controllers/$errorControllerName.php")) {
        require_once "application/controllers/$errorControllerName.php";
        $errorController = new $errorControllerName;
        if (method_exists($errorController, $errorMethodName)) {
            call_user_func_array([$errorController, $errorMethodName], [$message]);
        } else {
            die("Error method $errorMethodName not found in $errorControllerName!");
        }
    } else {
        die($message);
    }
}

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
        handleError("Controller $controllerName not found!");
        exit;
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
    handleError("Method $methodName not found!");
}

