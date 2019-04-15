<?php

require_once 'vendor/autoload.php';

use Symfony\Component\Dotenv\Dotenv;

$env = getenv('ENV');//chargement des variables d environnement seulement en local

if(!$env || $env === 'dev') {
    $dotenv = new DotEnv();
    $dotenv->load(__DIR__ . '/.env');

}

$controllerName = 'App\\Controller\\';

if(isset($_GET['c']) && !empty($_GET['c'])) {
    $controllerName .= ucfirst(strtolower($_GET['c'])) .'Controller';
    }else{
        $controllerName .= 'IndexController';
}

if (!class_exists($controllerName, true)){
    echo '404';
    exit;
}

$controller = new $controllerName();

if (isset($_GET['a']) && !empty($_GET['a'])) {
    $action = $_GET['a'];
} else {
    $action ='index';
}
if(!in_array($action, $methodsAvailable)){
    echo '404';
    exit;
}

$controller -> $action();