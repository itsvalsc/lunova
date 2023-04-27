<?php
class COrdini{
    public static function tutti(){
        $view = new VOrdini();
        $pers = FPersistentManager::getInstance();
        $session = FSessione::getInstance();
        if ($session->isLogged() && $session->isCliente()){
            $utente = $session->getUtente()->getIdClient();
            $elenco = $pers->prelevaCartItems($utente);
            $num = count($elenco);
            $ordini = $pers->LoadOrdini($utente);
            return $view->lista_ordini($ordini,true, $num);
        }else{
            return header("Location: /lunova");
        }

    }



    public static function AddToOrdini(){
        $view = new VCarrello();
        $pers = FPersistentManager::getInstance();
        $session = FSessione::getInstance();
        if ($session->isLogged() && $session->isCliente()){
            $utente = $session->getUtente()->getIdClient();
            $cart = $pers->prelevaCarrelloCorrente($utente);
            $elenco = $pers->prelevaCartItems($utente);
            $pers->AddOrdine($elenco, $cart->getId(),$utente);
            return $view->getFeedback(true);
        }else{
            return header("Location: /lunova");

        }

    }
}