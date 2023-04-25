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
     * @param $name
     * @param $dati
     */
    public function setData($name,$dati){
        $this->smarty->assign($name,$dati);
    }
    /**
     * @param $template
     */
    public function setTemplate($template){
        $this->smarty->display($template);
    }

    /**
     * Mostra la pagina di errore
     * @return void
     * @throws SmartyException
     */
    public function error()
    { $this->smarty->display('error.tpl'); }

    public function message($logged,$messaggio,$var_titolo,$var_url,$num,$cli){
        $this->setData('logged', $logged);
        $this->setData('message', $messaggio);
        $this->setData('var_titolo', $var_titolo);
        $this->setData('var_url', $var_url);
        $this->setData('num', $num);
        $this->setData('isCliente',$cli);
        $this->setTemplate("message.tpl");
    }

    public function message_admin($messaggio,$var_titolo,$var_url){
        $this->setData('message', $messaggio);
        $this->setData('var_titolo', $var_titolo);
        $this->setData('var_url', $var_url);
        $this->setTemplate("messageAdmin.tpl");
    }
}