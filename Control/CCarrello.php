<?php

class CCarrello{

    public static function mio_carrello(){
        $view = new VCarrello();
        $pers = FPersistentManager::getInstance();
        $session = FSessione::getInstance();
        if ($session->isLogged() && $session->isCliente()){
            $utente = $session->getUtente()->getIdClient();
            $elenco = $pers->prelevaCartItems($utente);
            $num = count($elenco);
            $Disc = $pers->prelevaCartDischiItems($utente);
            return $view->cart(true, $elenco,$Disc,$num);
        }else{
            return header ("Location: /lunova/");
        }
    }

    public static function Add(string $id){
        $view = new VCarrello();
        $e = new VErrore();
        $pers = FPersistentManager::getInstance();
        $session = FSessione::getInstance();
        if ($session->isLogged() && $session->isCliente()){
            $utente = $session->getUtente()->getIdClient();
            $cart = $pers->prelevaCarrelloCorrente($utente);
            if ($cart == null){
                $cart = new ECarrello($utente);
                $pers->store($cart);
            }
            $aggiungo = $pers->AddItem($id,$cart->getId(),$utente);

            return header ("Location: /lunova/Carrello/mio_carrello");
        }else {
            return header ("Location: /lunova");
        }
    }

    public static function Minus(string $id){
        $view = new VCarrello();
        $e = new VErrore();
        $pers = FPersistentManager::getInstance();
        $session = FSessione::getInstance();
        if ($session->isLogged() && $session->isCliente()){
            $utente = $session->getUtente()->getIdClient();
            $cart = $pers->prelevaCarrelloCorrente($utente);
            if ($cart == null){
                $elenco = $pers->prelevaCartItems($utente);
                $num = count($elenco);
                return $e->message(true,'Si è verificato un errore nel trovare il carrello in uso','alla home','',$num,true);
            }else{
                $aggiungo = $pers->MinusItem($id,$cart->getId(),$utente);
                return header ("Location: /lunova/Carrello/mio_carrello");
            }
        }else{
            return header ("Location: /lunova");
        }
    }



}