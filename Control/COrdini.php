<?php

/**
 * La classe COrdini implementa funzionalità per gli ordini effettuati sulla piattaforma. Ai clienti è consentito:
 * Visualizzare i propri ordini;
 * Confermare il checkout nel carrello ed inviare l'ordine, che questo momento apparirà sulla schermata personale
 * degli ordini.
 * @package Controller
 */
class COrdini{

    /**
     * Metodo che restituisce la schermata personale dei clienti dove è presente la lista degli ordini effettuati
     * @return null
     */
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


    /**
     * Metodo che permette agli utenti di confermare il checkout nel carrello e inviare l'ordine
     * @return null
     */
    public static function AddToOrdini(){
        $view = new VCarrello();
        $e = new VErrore();
        $pers = FPersistentManager::getInstance();
        $session = FSessione::getInstance();
        if ($session->isLogged() && $session->isCliente()){
            $utente = $session->getUtente()->getIdClient();
            $cart = $session->getCarrello();
            $elenco = $cart->getDischi();
            $num = count($elenco);
            if ($num==0){
                return $e->message(true,'Si prega di selezionare almeno un prodotto','al carrello','Carrello/mio_carrello',$num,true);
            }
            $ordine = $pers->AddOrdine($elenco,$utente);

            if (!$ordine[0]){
                if ($ordine[1]==null){
                    return $e->message(true,"Qualcosa è andato storto nel processare l'ordine, si prega di riprovare",'al carrello','Carrello/mio_carrello',$num,true);

                }else{
                    return $e->message(true,"quantità non piu disponibile per il disco '$ordine[1]', si prega di selezionare una quantità minore.",'al carrello','Carrello/mio_carrello',$num,true);
                }
            }
            $cart->setDischi([]);
            $session->setCarrello($cart);
            return $view->getFeedback(true);
        }else{
            return header("Location: /lunova");

        }

    }
}