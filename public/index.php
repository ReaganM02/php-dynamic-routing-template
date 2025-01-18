<?php

use App\Router\Router;
// Reference to the root folder.
const BASE_PATH = __DIR__ . '/../';


// Include functions.php
require_once BASE_PATH . 'app/functions.php';

// Autoload
spl_autoload_register(function($class) {
  $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);
  requireFile("{$class}.php");
});

$router = new Router();

requireFile('app/router/routes.php', ['router' => $router]);

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
$requestMethod = $_POST['__method'] ?? $_SERVER['REQUEST_METHOD'];

$router->request($uri, $requestMethod);
