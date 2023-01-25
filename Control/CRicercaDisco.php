<?php
class CRicercaDisco{
    public static function index(){
        $viewex = new VHome();
        FSessione::start();
        $logged = false;
        $viewex->ShowIndex($logged);
    }

    public static function newDisc(){
        $view = new VNewDisc();
        $pers = FPersistentManager::getInstance();
        FSessione::start();
        $elenco = $pers->prelevaGeneri();
        $view->new($elenco);
    }
}