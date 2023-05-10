<?php

/**
 * La classe CRicercaDisco implementa funzionalità per la ricerca di dischi sulla piattaforma. è possibile:
 * Mostrare la homepage
 * Effettuare la ricerca dei dischi in base ad alcuni dischi
 * @package Controller
 */
class CRicercaDisco{

    /**
     * Metodo che si occupa di mostrare la index/homepage del sito
     * @return null
     */
    public static function index(){
        $viewex = new VHome();
        $var = '';
        $utente = null;
        $logged= false;
        $num = null;
        $cli= false;
        $session = FSessione::getInstance();
        if ($session->isLogged()){
            $ut = $session->getUtente();
            $logged = true;
            $var = $ut->getUsername();

            $pers = FPersistentManager::getInstance();
            if ($session->isCliente()){
                $utente = $ut->getIdClient();
                $cli = true;
                $elenco = $pers->prelevaCartItems($session->getUtente()->getIdClient());
                $num = count($elenco);

            }elseif ($session->isArtista()){
                $utente = $ut->getIdArtista();
            }
            elseif (($session->isAdmin())){
                return header('Location: /lunova/Admin/usersadmin');
            }
        }
        return $viewex->ShowIndex($logged,$var, $num,$utente,$cli);
    }



    /**
     * Metodo che permette la ricerca del disco secondo vari filtri :nome,artista,genere
     * @param $gen
     * @return null
     */
    public static function ricerca($gen=null){
        $view = new VRicerca();
        $err = new VErrore();
        $pers = FPersistentManager::getInstance();
        $session = FSessione::getInstance();
        $num=null;
        $cli=false;
        $filtro = $view->getfiltro();
        $search = $view->getsearch();
        if($session->isLogged() && $session->isCliente()){
            $elenco = $pers->prelevaCartItems($session->getUtente()->getIdClient());
            $num = count($elenco);
            $cli = true;
        }
        if ($filtro=='disco'){
            $dischi = $pers->prelevaDischiperTitolo($search);
            $generi = $pers->prelevaGeneri();
            if (count($dischi)!=0){
                return $view->lista_prodotti($dischi,$session->isLogged(),$num,$generi,$cli);
            }else{
                return $err->message($session->isLogged(),'Disco non trovato','alla home','/lunova', $num, $cli);
            }
        }
        elseif ($gen!=null){
            $dischi = $pers->prelevaDischiperGen($gen);
            $generi = $pers->prelevaGeneri();
            if (count($dischi)!=0){
                return $view->lista_prodotti($dischi,$session->isLogged(),null,$generi,$cli);
            }else{
                return $err->message($session->isLogged(),'Non è stato trovato nessun disco per questa categoria','alla home','/lunova', $num, $cli);
            }
        }
        elseif ($filtro=='artista'){
            $dischi = $pers->prelevaDischiperAutore($search);
            $generi = $pers->prelevaGeneri();
            if (count($dischi)!=0){
                return $view->lista_prodotti($dischi, $session->isLogged(),null,$generi,$cli);
            }else{
                return $err->message($session->isLogged(),"Non sono stati trovati alcuni dischi per l'artista: $search",'alla home','/lunova', $num, $cli);
            }
        }
        else{
            return header("Location: /lunova/RicercaDisco/ricerca");
        }

    }





    /**
     * Metodo che mostra la schermata di aggiunta disco per l'artista
     * @return void
     */
    public static function newDisc(){
        $view = new VNewDisc();
        $pers = FPersistentManager::getInstance();
        $session = FSessione::getInstance();

        if ($session->isLogged() && $session->isArtista()){
            $elenco = $pers->prelevaGeneri();
            return $view->new(true,$elenco);
        }else{
            return header('Location: /lunova/Errore/unathorized');
        }
    }
}