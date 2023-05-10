<?php
class CAboutUs{

    /**
     * Metodo che restituisce la pagina di About Us: pagina descrittiva del sito
     * @return null
     */
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
            $elenco = $pers->prelevaCartItems($utente);
            $num = count($elenco);
            return $view->about_us(true, $num,$cli);
        }else{
            return $view->about_us($session->isLogged(), $num, $cli);
        }


    }
}