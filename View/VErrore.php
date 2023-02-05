<?php

/**
 * Class VErrore si occupa di gestire la visualizzazione della pagina di errore
 * @package View
 */

class VErrore
{
    private Smarty $smarty;

    /** Funzione che inizializza e configura smarty. */
    public function __construct()
    { $this->smarty = StartSmarty::configuration(); }

    /**
     * Mostra la pagina di errore
     * @return void
     * @throws SmartyException
     */
    public function error()
    { $this->smarty->display('error.tpl'); }

}