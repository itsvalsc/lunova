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



    public static function AddToOrdini(){
        $view = new VCarrello();
        $l = true;
        $pers = FPersistentManager::getInstance();
        $utente = 'C151'; //sessione
        $cartid = 'F94';
        $elenco = $pers->prelevaCartItems($utente);
        $pers->AddOrdine($elenco, $cartid,$utente);
        $view->getFeedback($l);
    }
}