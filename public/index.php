<?php

require_once '../app/Model.php';
require_once '../app/View.php';
require_once '../app/Controller.php';

$model = new Model();
$view = new View();
$controller = new Controller($model, $view);

$controller->handleRequest();
