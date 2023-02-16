<?php
class CSondaggi{
    public static function show(){
        $view = new VSondaggi();
        $logged = false;

        $votazione = false;
        $ut = null;
        $session = FSessione::getInstance();
        $pers = FPersistentManager::getInstance();
        $sondaggio = $pers->prelevaSondaggioInCorso();
        if ($session->isLogged() && $session->isCliente()){
            $ut = $session->getUtente();
            $votazione= $pers->exist('FVotazione',$ut->getIdClient(),$sondaggio->getId());
            $view->show($sondaggio,$votazione,true);
        }elseif($session->isLogged() && $session->isArtista()){
            $view->show($sondaggio,true,true);
        }
        else{
            header("Location: /lunova");

        }
    }

    public static function vota(string $id){
        $view = new VSondaggi();
        $utente = null;
        $logged = false;
        $votazione = false;
        $pers = FPersistentManager::getInstance();
        $session = FSessione::getInstance();

        if ($session->isLogged()){
            $ut = $session->getUtente();
            $logged = true;
            $votazione = $pers->vota($id,$ut->getIdClient());
        }
        $sondaggio = $pers->prelevaSondaggioInCorso();
        //poi gestione eccezioni
        $view->show($sondaggio,$votazione,$logged);
    }

    public function nuovoSondaggio(){
        $d1='';
        $d2='';
        $d3='';
        $pers = FPersistentManager::getInstance();
        $disco1 = $pers->load('FDisco',$d1);
        $disco2 = $pers->load('FDisco',$d2);
        $disco3 = $pers->load('FDisco',$d3);
        $sondaggio = new ESondaggio($disco1,$disco2,$disco3,'2023-01-10');
        $pers->crea_sondaggio($sondaggio);
        //nuova view o modifica in locale dopo aver premuto il pulsante?
    }


    public function mostraRichieste() {

       $pers = FPersistentManager::getInstance();
       $richieste = $pers->prelevaRichieste();

    }

    public static function richiestaSondaggio($id) {
        $pers = FPersistentManager::getInstance();
        $richiesta = new ERichiesta($id,'2023-01-10');
        $pers->store($richiesta);
        //nuova view o modifica in locale dopo aver premuto il pulsante?
    }









}
