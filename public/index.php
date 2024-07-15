<?php
require_once __DIR__ . '/../src/config/config.php';
use App\Controllers\HomeController;

$controller = new HomeController();
$controller->index();