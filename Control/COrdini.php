<?php
class COrdini{
    public static function tutti(){
        $view = new VOrdini();
        $l = true;
        $pers = FPersistentManager::getInstance();
        $utente = 'C151'; //sessione
        $elenco = $pers->prelevaCartItems($utente);
        $num = count($elenco);
        $view->about_us($elenco,$l, $num);
    }
}