<?php
require_once 'Utility/autoload.php';
require_once 'StartSmarty.php';
require_once 'Smarty/smarty-dir/templates/header.tpl';
//require_once 'Smarty/smarty-dir/templates/products_list.tpl';
//require_once 'Smarty/smarty-dir/templates/homepage.tpl';
/*
require_once 'Smarty/smarty-dir/templates/header.tpl';
require_once 'Smarty/smarty-dir/templates/footer.tpl';
require_once 'Smarty/smarty-dir/templates/sidebar.tpl';
*/

require_once "./Foundation/FCliente.php";
require_once "./Entity/ECliente.php";
require_once "./Entity/EUtente.php";
require_once "./Entity/ECarta.php";
require_once "./Entity/EWallet.php";
require_once "./Foundation/FConnectionDB.php";
require_once "./inc/configdb.php";
require_once "./Foundation/FDisco.php";
require_once "./Entity/EDisco.php";
require_once "./Entity/EOrdine.php";
require_once "./Foundation/FOrdine.php";
require_once "./Entity/ESondaggio.php";
require_once "./Entity/ERichiesta.php";
require_once "./Foundation/FSondaggio.php";
require_once "./Foundation/FRichiesta.php";
require_once "./Entity/EVotazione.php";
require_once "./Foundation/FVotazione.php";
require_once "./Foundation/FPersistentManager.php";
require_once "./Foundation/FArtista.php";
require_once "./Entity/EArtista.php";
require_once "./inc/init.php";

$controller = new CFrontController();
$controller->run($_SERVER['REQUEST_URI']);
//header('Location: templates/index.tpl');
//header("Set-Cookie: cross-site-cookie=whatever; SameSite=None; Secure");
//exit;
