<?php

/**
 * La classe VAdmin si occupa dell'input-output per la sezione privata dell'admin
 * @package View
 */
class VAdmin
{
    private $smarty;

    /** Funzione che inizializza e configura smarty. */
    function __construct ()
    { $this->smarty = StartSmarty::configuration(); }

    /** Funzione che riprende gli ordini e li mostra all'admin */
    public function Ordini_Admin($ordine) {
        $this->smarty->assign('ordine',$ordine);
        $this->smarty->display('ordini_admin.tpl');
    }

}