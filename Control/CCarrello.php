<?php

/**
 * La classe CCarrello implementa funzionalità per il carrello della piattaforma. Ai clienti è consentito:
 * * visualizzare il proprio carrello con i relativi prodotti;
 * * Aggiungere o eliminare i prodotti;
 * * Confermare l'ordine checkout).
 * @package Controller
 */
class CCarrello{

    /**
     * Metodo che restituisce il carrello con i prodotti contenuti al suo interno.
     * @return null
     */
    public static function mio_carrello(){
        $view = new VCarrello();
        $pers = FPersistentManager::getInstance();
        $session = FSessione::getInstance();
        if ($session->isLogged() && $session->isCliente()){
            $utente = $session->getUtente()->getIdClient();
            $elenco = $session->getCarrello()->getDischi();
            $num = count($elenco);
            $Disc=array();
            foreach ($elenco as $dc){
                $id = $dc->getIdItem();
                $disco = $pers->load('FDisco',$id);
                array_push($Disc,$disco);
            }

            $prices = $pers->rescue_prices($elenco);

            return $view->cart(true, $elenco,$Disc,$num,$prices);
        }else{
            return header ("Location: /lunova/");
        }
    }

    /**
     * Metodo utilizzato per aggiungere un prodotto al carrello( se gia presente la quantità è aumentata di 1).
     * @param string $id
     * @return null
     */
    public static function Add(string $id){
        $view = new VCarrello();
        $e = new VErrore();
        $pers = FPersistentManager::getInstance();
        $session = FSessione::getInstance();
        if ($session->isLogged() && $session->isCliente()){
            $utente = $session->getUtente()->getIdClient();
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


            return header ("Location: /lunova/Carrello/mio_carrello");
        }else {
            return header ("Location: /lunova");
        }
    }

    /**
     * Metodo utilizzato per eliminare un prodotto al carrello( se gia presente la quantità è diminuita di 1).
     * @param string $id
     * @return null
     */
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