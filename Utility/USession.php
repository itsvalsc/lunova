<?php

require_once 'Smarty/smarty-lib/Smarty.class.php';

class USession
{
    /**
     * Costruttore della classe USession.
     */
    public function __construct()
    {
        if(!isset($_SESSION))
        {session_start();}
    }

    /**
     * Metodo che verifica se un untente è loggato o meno
     * @return bool
     */
    public function isLogged(): bool {
        $identificato = false;
        if (isset($_COOKIE['PHPSESSID']) && isset($_SESSION['user'])){
            $identificato = true;
        }
        return $identificato;
    }

    /**
     * Va ad eliminare la sessione, rimuovendone ogni traccia.
     * @return void
     */
    function close_session() {
        session_unset();
        session_destroy();
        //setcookie('PHPSESSID',null);
    }

}