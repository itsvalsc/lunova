<?php



/**
 * La classe CErrore è utilizzata per lanciare la schermata di errore a seguito di richieste errate.
 * @package Controller
 */

class CErrore
{

    /**
     * Mostra la pagina di errore
     * @throws SmartyException
     */
    public static function mostraPaginaErrore()
    {
        $view = new VErrore();
        $view->error();
    }

    /**
     * Mostra la pagina di errore a seguito di accesso ad una pagina non autorizzata
     * @return void
     */
    public static function unathorized(){
        $v = new VErrore();
        $num = null;
        $cli = false;
        $session = FSessione::getInstance();
        $pers = FPersistentManager::getInstance();
        $logged = $session->isLogged();
        if ($logged && $session->isCliente()){
            $elenco = $pers->prelevaCartItems($session->getUtente()->getIdClient());
            $num = count($elenco);
            $cli = true;
        }
        $v->message($logged,"Impossibile completare l'azione o accedere in questa sezione",'alla homepage','',$num,$cli);
    }


    /**
     * Mostra la pagina di errore a seguito di una richiesta errata o di un errore interno all'applicazione
     * @return void
     */
    public static function redirect(){
        $v = new VErrore();
        $num = null;
        $cli = false;
        $session = FSessione::getInstance();
        $pers = FPersistentManager::getInstance();
        $logged = $session->isLogged();
        if ($logged && $session->isCliente()){
            $elenco = $pers->prelevaCartItems($session->getUtente()->getIdClient());
            $num = count($elenco);
            $cli = true;
        }
        $v->message($logged,"Qualcosa è andato storto :(",'alla homepage','',$num,$cli);
    }

    /**
     * Mostra la pagina di errore a seguito alla composizione di un URL sbagliat o non valida
     * @return void
     */
    public static function BadRequest(){
        $v = new VErrore();
        $num = null;
        $cli = false;
        $session = FSessione::getInstance();
        $pers = FPersistentManager::getInstance();
        $logged = $session->isLogged();
        if ($logged && $session->isCliente()){
            $elenco = $pers->prelevaCartItems($session->getUtente()->getIdClient());
            $num = count($elenco);
            $cli = true;
        }
        $v->message($logged,"ERROR 400: Url non valida o malformata",'alla homepage','',$num,$cli);
    }
}