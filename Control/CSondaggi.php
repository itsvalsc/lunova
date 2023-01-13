<?php
class CSondaggi{
    public static function show(){
        $view = new VSondaggi();
        $utente = 'ut1';
        $pers = FPersistentManager::getInstance();

        $sondaggio = $pers->prelevaSondaggioInCorso();
        $votazione= $pers->exist('FVotazione',$utente,$sondaggio);
        $view->show($sondaggio,$votazione);
    }

    public static function vota(string $id){
        $view = new VSondaggi();
        $utente = 'ut1'; //implementazione tramite sessioni
        $pers = FPersistentManager::getInstance();
        $votazione = $pers->vota($id,$utente);
        $sondaggio = $pers->prelevaSondaggioInCorso();
        $view->show($sondaggio,1);
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
