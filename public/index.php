<?php
require_once __DIR__ . '/../vendor/autoload.php';

use App\Router;

$router = new Router();

// Define routes
$router->add('GET', '/', 'HomeController@index');
$router->add('GET', '/register', 'RegisterController@showForm');
$router->add('POST', '/register', 'RegisterController@register');

// Dispatch the request
$router->dispatch();
