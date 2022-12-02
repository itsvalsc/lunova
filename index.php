<?php
require_once './Utility/autoload.php';
require_once 'StartSmarty.php';
//require_once 'Smarty/smarty-dir/templates/header.tpl';
//require_once 'Smarty/smarty-dir/templates/products_list.tpl';
//require_once 'Smarty/smarty-dir/templates/homepage.tpl';
/*
require_once 'Smarty/smarty-dir/templates/header.tpl';
require_once 'Smarty/smarty-dir/templates/footer.tpl';
require_once 'Smarty/smarty-dir/templates/sidebar.tpl';
*/

$controller = new CFrontController();
$controller->run($_SERVER['REQUEST_URI']);
//header('Location: templates/index.tpl');
//header("Set-Cookie: cross-site-cookie=whatever; SameSite=None; Secure");
//exit;
