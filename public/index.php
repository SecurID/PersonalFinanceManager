<?php
require_once __DIR__ . '/../src/bootstrap.php';

use App\Router;

$router = new Router();

// Define routes
$router->add('GET', '/', 'HomeController@index');
$router->add('GET', '/category', 'CategoryController@index');

// Dispatch the request
$router->dispatch();
