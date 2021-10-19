<?php
require "../vendor/autoload.php";

function e404()
{
    require '../public/404.php';
    exit();
}

//méthode pour débuger 
function dd(...$vars)
{
    foreach ($vars as $var) {
        echo '<pre>';
        print_r($var);
        echo '</pre>';
    }
}

function get_pdo()
{
    return new PDO('mysql:host=localhost;dbname=calendrier', 'root', '', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
}

//méthode pour les injections
function h($value)
{
    if ($value === null) {
        return '';
    }
    return htmlentities($value);
}

function render($view, $parameters = [])
{
    extract($parameters);
    include "../views/{$view}.php";
}
