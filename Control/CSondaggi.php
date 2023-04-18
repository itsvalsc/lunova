<?php
class CSondaggi{
    public static function show(){
        $view = new VSondaggi();
        $error = new VErrore();
        $logged = false;
        $num = null;
        $votazione = false;
        $ut = null;
        $session = FSessione::getInstance();
        $pers = FPersistentManager::getInstance();
        $sondaggio = $pers->prelevaSondaggioInCorso();
        if ($sondaggio==null){
            return $error->message($session->isLogged(),'Ci dispiace, non è in corso nessun sondaggio','alla homepage','');
        }

        if ($session->isLogged() && $session->isCliente()){
            $utente = $session->getUtente()->getIdClient();
            /* todo:reinserire variabili per carrello
            $cartid = $session->getCarrello()->getId();
            $elenco = $pers->prelevaCartItems($cartid);
            $num = count($elenco);*/
            $votazione= $pers->exist('FVotazione',$utente,$sondaggio->getId());
            $view->show($sondaggio,$votazione,true, $num);
        }else{

            $view->show($sondaggio,true,$session->isLogged(), $num );
        }
    }

    public static function vota(string $id){
        $view = new VSondaggi();
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


    public static function nuovoSondaggio(){
        $v = new VErrore();
        $session = FSessione::getInstance();
        if ($session->isLogged() || $session->isAdmin()){
            $pers = FPersistentManager::getInstance();
            $dischi=$_POST;
            $a=array();
            foreach ($dischi as $n =>$value){
                $a[]=$value;
            }
            if(count($a)!=3){
                $v->message(true,'selezionare solo 3 sondaggi','alle notifiche','Admin/notifiche');
            }

            $d1=$a[0];
            $d2=$a[1];
            $d3=$a[2];
            $disco1 = $pers->load('FDisco',$d1);
            $disco2 = $pers->load('FDisco',$d2);
            $disco3 = $pers->load('FDisco',$d3);

            $sondaggio = new ESondaggio($disco1,$disco2,$disco3,(string)date('c'));

            $pers->crea_sondaggio($sondaggio);
            $v->message(true,'Sondaggio creato con successo','alle notifiche','Admin/notifiche');
        }
        else{
            header("Location: /lunova");
        }




        //nuova view o modifica in locale dopo aver premuto il pulsante?
    }




    public static function richiestaSondaggio($id) {
        $sessione = FSessione::getInstance();
        $view = new VErrore();
        if ($sessione->isLogged() && $sessione->isArtista()){
            $pers = FPersistentManager::getInstance();
            $artista = $sessione->getUtente();
            $name = $artista->getUsername();
            $idArt = $artista->getIdArtista();
            $bool = $pers->exist('FRichiesta',$id);
            if ($bool){
                return $view->message($sessione->isLogged(),'richiesta gia effettuata per questo disco','indietro',"Profile/users/$idArt");
            }
            $richiesta = new ERichiesta($id,(string)date('c'),$name);
            $pers->store($richiesta);
            return $view->message($sessione->isLogged(),'richiesta effuata, ci vorrà un po di tempo prima che la tua richiesta venga elaborata ed apparirà il suo disco in un sondaggio','alla home','');
        }else{
            header("Location: /lunova");
        }
    }









}
