<?php
class CAboutUs{

    public static function us(){
        $view = new VAbout();
        $error = new VErrore();
        $l = false;
        $num = null;
        $cli = false;
        $session = FSessione::getInstance();
        $pers = FPersistentManager::getInstance();

        if ($session->isLogged() && $session->isCliente()){
            $utente = $session->getUtente()->getIdClient();
            $cli = true;
            /* todo:reinserire variabili per carrello
            $cartid = $session->getCarrello()->getId();
            $elenco = $pers->prelevaCartItems($cartid);
            $num = count($elenco);*/
            $elenco = $pers->prelevaCartItems($utente);
            $num = count($elenco);
            $view->about_us(true, $num,$cli);
        }else{
            $view->about_us($session->isLogged(), $num, $cli);
        }


    }
}