<?php
class CCarrello{
    public static function mio_carrelloF(){
        $view = new VCarrello();
        $pers = FPersistentManager::getInstance();
        $session = FSessione::getInstance();
        if ($session->isLogged() && $session->isCliente()){
            //$utente = $session->getUtente()->getIdClient();
            $cartid = $session->getCarrello()->getId();
            $pers = FPersistentManager::getInstance();
            $elenco = $pers->prelevaCartItems($cartid);
            $num = count($elenco);
            $Disc = $pers->prelevaCartDischiItems($cartid);
            $view->cart($session->isLogged(),$elenco,$Disc, $num);
        }else{
            header('Location: /lunova/Errore/unathorized');
        }
    }

    public static function AddF(string $id){
        $view = new VCarrello();
        $session = FSessione::getInstance();
        if ($session->isLogged() && $session->isCliente()){
            $utente = $session->getUtente()->getIdClient();
            $cartid = $session->getCarrello()->getId();
            $pers = FPersistentManager::getInstance();
            $aggiungo = $pers->AddItem($id,$cartid,$utente);
            header ("Location: /lunova/Carrello/mio_carrello");

            //$Disc = $pers->prelevaCartDischiItems($utente);
        }
        else{
            $view->message($session->isLogged(),'per inserire elementi nel carrello devi prima accedere','ai prodotti','Product_list/elenco_dischi');
        }
        header ("Location: /lunova/Carrello/mio_carrello");
        //$view->cart($l, $elenco,$Disc, $num);
    }

    public static function MinusF(string $id){
        $view = new VCarrello();
        $session = FSessione::getInstance();
        if ($session->isLogged() && $session->isCliente()){
            $utente = $session->getUtente()->getIdClient();
            $cartid = $session->getCarrello()->getId();
            $pers = FPersistentManager::getInstance();
            $aggiungo = $pers->MinusItem($id,$cartid,$utente);
            header ("Location: /lunova/Carrello/mio_carrello");

            //$Disc = $pers->prelevaCartDischiItems($utente);
        }
        else{
            header('Location: /lunova');
        }
    }

    public static function Acquisto(){
        $view = new VCarrello();
        $l = true;
        $view->getFeedback($l);
    }

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