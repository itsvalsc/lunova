<?php

class CCarrello{

    public static function mio_carrello(){
        $view = new VCarrello();
        $pers = FPersistentManager::getInstance();
        $session = FSessione::getInstance();
        if ($session->isLogged() && $session->isCliente()){
            $utente = $session->getUtente()->getIdClient();
            //$elenco = $pers->prelevaCartItems($utente);
            $elenco = $session->getCarrello()->getDischi();
            $num = count($elenco);
            $Disc=array();
            foreach ($elenco as $dc){
                $id = $dc->getIdItem();
                $disco = $pers->load('FDisco',$id);
                array_push($Disc,$disco);
            }

            //$Disc = $pers->prelevaCartDischiItems($utente);
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
            //$cart = $pers->prelevaCarrelloCorrente($utente);
            $cart = $session->getCarrello();
            $dischi = $cart->getDischi();
            $disco = $pers->load('FDisco',$id);
            $checkQta = $pers->checkQta($id);
            if ($disco!=null && $checkQta){
                $bool = false;
                foreach ($dischi as $dc){
                    if ($dc->getIdItem() == $id){
                        $dc->addQuantity();
                        $bool=true;
                    }
                }
                if (!$bool){
                    array_push($dischi,new ECartItem($disco));
                }
            }
            $cart->setDischi($dischi);
            $session->setCarrello($cart);

            //$aggiungo = $pers->AddItem($id,$cart->getId(),$utente);

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
            $cart = $session->getCarrello();
            $dischi = $cart->getDischi();
            $disco = $pers->load('FDisco',$id);

            if ($disco!=null){
                foreach ($dischi as $dc){
                    if ($dc->getIdItem() == $id){
                        if ($dc->getQuantity()==1){
                            $posizione = array_search($dc, $dischi);
                            unset($dischi[$posizione]);
                            $dischi = array_merge($dischi);


                        }else{
                            $dc->minusQuantity();
                        }
                    }
                }
            }
            $cart->setDischi($dischi);
            $session->setCarrello($cart);
            return header ("Location: /lunova/Carrello/mio_carrello");

        }else{
            return header ("Location: /lunova");
        }
    }



}