<?php
    require_once('./Config/Parameters.php');
    session_start();

    $defaultController = "UserController";

    $url = $_GET['url'];
    $partsUrl = explode('/',$url);

 

    $controller = !empty($partsUrl[0]) ? $partsUrl[0].'Controller' : $defaultController;
    $action = !empty($partsUrl[1]) ? $partsUrl[1] : 'index';

    $controllerFile = "Controllers/{$controller}.php";

    if (file_exists($controllerFile)) {
        require_once $controllerFile;
    }

    $instance = new $controller();
    if (method_exists($instance,$action)) {
        $instance->$action();
    }

    
?>