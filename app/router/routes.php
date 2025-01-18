<?php
$router->addRoute('GET', '/', function() {
  requireController('index.controller.php');
});