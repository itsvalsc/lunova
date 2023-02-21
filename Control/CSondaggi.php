<?php
class CSondaggi{
    public static function show(){
        $view = new VSondaggi();
        $logged = false;
        $num = null;
        $votazione = false;
        $ut = null;
        $session = FSessione::getInstance();
        $pers = FPersistentManager::getInstance();
        $sondaggio = $pers->prelevaSondaggioInCorso();

        if ($session->isLogged() && $session->isCliente()){
            $utente = $session->getUtente()->getIdClient();
            $cartid = $session->getCarrello()->getId();
            $elenco = $pers->prelevaCartItems($cartid);
            $num = count($elenco);
            $votazione= $pers->exist('FVotazione',$utente,$sondaggio->getId());
            $view->show($sondaggio,$votazione,true, $num);
        }else{

            $view->show($sondaggio,true,$session->isLogged(), $num );
        }
    }

    public static function vota(string $id){
        $view = new VSondaggi();
        $utente = null;
        $logged = false;
        $votazione = false;
        $pers = FPersistentManager::getInstance();
        $session = FSessione::getInstance();
        $sondaggio = $pers->prelevaSondaggioInCorso();

        if ($session->isLogged()){
            $ut = $session->getUtente();
            $votazione= $pers->exist('FVotazione',$ut->getIdClient(),$sondaggio->getId());
            if (!$votazione){
                $votazione = $pers->vota($id,$ut->getIdClient());
            }
        }
        header("Location: /lunova/Sondaggi/show");

    }


    public function nuovoSondaggio(){
        $session = FSessione::getInstance();
        if ($session->isLogged() || $session->isAdmin()){
            $pers = FPersistentManager::getInstance();
            $d1=$_POST['disco1'];// cambiare variabile disco1 in base al name della form post sui template
            $d2=$_POST['disco2'];
            $d3=$_POST['disco3'];
            $disco1 = $pers->load('FDisco',$d1);
            $disco2 = $pers->load('FDisco',$d2);
            $disco3 = $pers->load('FDisco',$d3);
            $sondaggio = new ESondaggio($disco1,$disco2,$disco3,'2023-01-10'); //inserire data odierna
            $pers->crea_sondaggio($sondaggio);
        }
        else{
            header("Location: /lunova");
        }




        //nuova view o modifica in locale dopo aver premuto il pulsante?
    }


    public function mostraRichieste() {

       $pers = FPersistentManager::getInstance();
       $richieste = $pers->prelevaRichieste();

    }

    public static function richiestaSondaggio($id) {
        $sessione = FSessione::getInstance();
        if ($sessione->isLogged() || $sessione->isArtista()){
            $pers = FPersistentManager::getInstance();
            $id = $_POST['disco'];
            $richiesta = new ERichiesta($id,'2023-01-10'); //todo: data
            $pers->store($richiesta);
        }

        //nuova view o modifica in locale dopo aver premuto il pulsante?
    }









}
