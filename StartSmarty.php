<?php
require('Smarty/smarty-lib/Smarty.class.php');

class StartSmarty{
    public static function configuration(){
        $smarty=new Smarty();
        $smarty->setTemplateDir('Smarty/smarty-dir/templates/');
        $smarty->setCompileDir('Smarty/smarty-dir/templates_c/');
        $smarty->setConfigDir('Smarty/smarty-dir/configs/');
        $smarty->setCacheDir('Smarty/smarty-dir/cache/');
        return $smarty;
    }
}
