<?php
require_once './Utility/autoload.php';
require_once 'StartSmarty.php';


$controller = new CFrontController();
$controller->run($_SERVER['REQUEST_URI']);

