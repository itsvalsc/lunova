<?php

require_once "Utility/autoload.php";
require_once "Foundation/FSessione.php";

/**
 * La classe CErrore è utilizzata per lanciare la schermata di errore a seguito di richieste errate.
 * @package Controller
 */

class CErrore
{
    public static ?CErrore $instance = null;

    /** Costruttore della classe */
    private function __construct() {}

    /**
     * Restituisce l'istanza della classe
     * @return CErrore|null
     */
    public static function getInstance(): ?CErrore
    {
        if (!isset(self::$instance)) {
            self::$instance = new CErrore();
        }
        return self::$instance;
    }

    /**
     * Mostra la pagina di errore
     * @throws SmartyException
     */
    public static function mostraPaginaErrore()
    {
        $view = new VErrore();
        $view->error();
    }
    public static function unathorized(){
        $v = new VErrore();
        $session = FSessione::getInstance();
        $logged = $session->isLogged();
        $v->message($logged,"Impossibile accedere in questa sezione",'alla homepage','/');
    }
}