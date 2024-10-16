<?php

$action = 'index';
if (isset($_GET['action'])) {
    $action = trim($_GET['action']);
}

$routes = $config['routes'];
if (isset($routes[$action])) {
    [$controller_class, $method] = explode('@', $routes[$action]);
    $controller = new $controller_class($storage);
    $controller->$method();
}
