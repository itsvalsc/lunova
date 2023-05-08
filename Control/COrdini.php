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
        $e = new VErrore();
        $pers = FPersistentManager::getInstance();
        $session = FSessione::getInstance();
        if ($session->isLogged() && $session->isCliente()){
            $utente = $session->getUtente()->getIdClient();
            $cart = $session->getCarrello();
            $elenco = $cart->getDischi();
            $num = count($elenco);
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