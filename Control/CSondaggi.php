<?php
class CSondaggi{

    public static function show(){
        $view = new VSondaggi();
        $error = new VErrore();
        $logged = false;
        $num = null;
        $cli = false;
        $votazione = false;
        $ut = null;
        $session = FSessione::getInstance();
        $pers = FPersistentManager::getInstance();
        $sondaggio = $pers->prelevaSondaggioInCorso();


        if ($session->isLogged() && $session->isCliente()){
            $utente = $session->getUtente()->getIdClient();
            $cli = true;
            $elenco = $pers->prelevaCartItems($utente);
            $num = count($elenco);
            if ($sondaggio==null){
                return $error->message($session->isLogged(),'Ci dispiace, non è in corso nessun sondaggio','alla homepage','',$num,$cli);
            }
            $votazione= $pers->exist('FVotazione',$utente,$sondaggio->getId());
            return $view->show($sondaggio,$votazione,true, $num,$cli);
        }else{
            if ($sondaggio==null){
                return $error->message($session->isLogged(),'Ci dispiace, non è in corso nessun sondaggio','alla homepage','',$num,$cli);
            }else{
                $view->show($sondaggio,true,$session->isLogged(), $num, $cli );
            }

        }
    }

    public static function vota(string $id){
        $view = new VSondaggi();
        $pers = FPersistentManager::getInstance();
        $session = FSessione::getInstance();
        $sondaggio = $pers->prelevaSondaggioInCorso();

        if ($session->isLogged() && $session->isCliente()){
            $ut = $session->getUtente();
            $votazione= $pers->exist('FVotazione',$ut->getIdClient(),$sondaggio->getId());
            if (!$votazione){
                $votazione = $pers->vota($id,$ut->getIdClient());
            }
        }
        return header("Location: /lunova/Sondaggi/show");

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
                return $v->message_admin('selezionare solo 3 sondaggi','alle notifiche','Admin/notifiche');
            }

            $d1=$a[0];
            $d2=$a[1];
            $d3=$a[2];
            $disco1 = $pers->load('FDisco',$d1);
            $disco2 = $pers->load('FDisco',$d2);
            $disco3 = $pers->load('FDisco',$d3);

            $sondaggio = new ESondaggio($disco1,$disco2,$disco3,(string)date('c'));

            $pers->crea_sondaggio($sondaggio);
            return $v->message_admin('Sondaggio creato con successo','alle notifiche','Admin/notifiche');
        }
        else{
            return header("Location: /lunova");
        }




        //nuova view o modifica in locale dopo aver premuto il pulsante?
    }




    public static function richiestaSondaggio($id) {
        $sessione = FSessione::getInstance();
        $view = new VErrore();
        $num = null;
        $cli = false;
        if ($sessione->isLogged() && $sessione->isArtista()){
            $pers = FPersistentManager::getInstance();
            $artista = $sessione->getUtente();
            $name = $artista->getUsername();
            $idArt = $artista->getIdArtista();
            $bool = $pers->exist('FRichiesta',$id);
            if ($bool){
                return $view->message($sessione->isLogged(),'richiesta gia effettuata per questo disco','indietro',"Profile/users/$idArt",$num,$cli);
            }
            $richiesta = new ERichiesta($id,(string)date('c'),$name);
            $pers->store($richiesta);
            return $view->message($sessione->isLogged(),'richiesta effuata, ci vorrà un po di tempo prima che la tua richiesta venga elaborata ed apparirà il suo disco in un sondaggio','alla home','',$num, $cli);
        }else{
            return header("Location: /lunova");
        }
    }
}
