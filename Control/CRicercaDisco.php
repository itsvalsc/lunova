<?php
class CRicercaDisco{
    public static function index(){
        $viewex = new VHome();
        $var = '';
        $logged= false;
        $session = FSessione::getInstance();
        if ($session->isLogged()){
            $ut = $session->getUtente();
            $logged = true;
            $var = $ut->getUsername();
        }

        $viewex->ShowIndex($logged,$var);
    }

    public static function newDisc(){
        $view = new VNewDisc();
        $pers = FPersistentManager::getInstance();
        $session = FSessione::getInstance();

        if ($session->isLogged() && $session->isArtista()){
            $elenco = $pers->prelevaGeneri();
            $view->new(true,$elenco);
        }else{
            $view->message($session->isLogged(),'impossibile accedere in questa sezione', 'homepage','RicercaDisco/index');
        }

    }
}