<?php
class COrdini{
    public static function tutti(){
        $view = new VOrdini();
        $l = true;
        $pers = FPersistentManager::getInstance();
        $utente = 'C151'; //sessione
        $elenco = $pers->prelevaCartItems($utente);
        $num = count($elenco);
        $ordini = $pers->LoadOrdini($utente);
        $view->lista_ordini($ordini,$l, $num);
    }
}