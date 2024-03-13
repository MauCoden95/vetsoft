<?php
require_once('./Config/Parameters.php');
session_start();


$url = isset($_GET['url']) ? filter_var($_GET['url'], FILTER_SANITIZE_URL) : '';
$partsUrl = explode('/', $url);

$defaultController = "UserController";
$controllerName = !empty($partsUrl[0]) ? $partsUrl[0] . 'Controller' : $defaultController;
$action = !empty($partsUrl[1]) ? $partsUrl[1] : 'index';


spl_autoload_register(function ($className) {
    $file = "Controllers/{$className}.php";
    if (file_exists($file)) {
        require_once $file;
    }
});


if (!class_exists($controllerName)) {
    die("Controlador no encontrado");
}

$instance = new $controllerName();

if (!method_exists($instance, $action)) {
    die("Acción no encontrada");
}

$instance->$action();
?>
