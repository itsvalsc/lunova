<?php
class CRicercaDisco{
    public static function index(){
        $viewex = new VHome();
        $var = '';
        $utente = null;
        $logged= false;
        $num = null;
        $session = FSessione::getInstance();
        if ($session->isLogged()){
            $ut = $session->getUtente();
            $logged = true;
            $var = $ut->getUsername();

            $pers = FPersistentManager::getInstance();
            if ($session->isCliente()){
                $utente = $ut->getIdClient();
                /* //todo:commentata parte del carrello x vale
                if ($pers->exist('FCarrello',$utente)){   //se esiste il carrello in sessione
                    $elenco = $pers->prelevaCartItems($session->getUtente()->getIdClient());
                    $num = count($elenco);
                }
                else{   //se non esiste il carrello in sessione
                    $car = new ECarrello($utente);
                    $pers->store($car);
                    $num = 0;
                }*/
            }elseif ($session->isArtista()){
                $utente = $ut->getIdArtista();
            }
            elseif (($session->isAdmin())){
                //return header('Location: /lunova/Admin/usersadmin');
            }
        }
        $viewex->ShowIndex($logged,$var, $num,$utente);
    }

    public static function newDisc(){
        $view = new VNewDisc();
        $pers = FPersistentManager::getInstance();
        $session = FSessione::getInstance();

        if ($session->isLogged() && $session->isArtista()){
            $elenco = $pers->prelevaGeneri();
            $view->new(true,$elenco);
        }else{
            //$view->message($session->isLogged(),'impossibile accedere in questa sezione', 'homepage','RicercaDisco/index');
            header('Location: /lunova/Errore/unathorized');
        }
    }

    public static function ricerca($gen=null){
        $view = new VRicerca();
        $pers = FPersistentManager::getInstance();
        $session = FSessione::getInstance();
        $filtro = $view->getfiltro();
        $search = $view->getsearch();
        if($session->isLogged() && $session->isCliente()){
            //$cartid = $session->getCarrello()->getId();
            //$elencoitems = $pers->prelevaCartItems($cartid);
            //$num = count($elencoitems);
            $num = null; //todo:aggiungere carrello
        }
        else{
            $num=null;
        }
        if ($filtro=='disco'){
            $dischi = $pers->prelevaDischiperTitolo($search);
            $generi = $pers->prelevaGeneri();
            if (count($dischi)!=0){
                $view->lista_prodotti($dischi,$session->isLogged(),$num,$generi);
            }else{
                $view->message($session->isLogged(),'Disco non trovato','alla home','/lunova');
            }
        }
        elseif ($gen!=null){
            $dischi = $pers->prelevaDischiperGen($gen);
            $generi = $pers->prelevaGeneri();
            if (count($dischi)!=0){
                $view->lista_prodotti($dischi,$session->isLogged(),null,$generi);
            }else{
                $view->message($session->isLogged(),'Non è stato trovato nessun disco per questa categoria','alla home','/lunova');
            }
        }
        elseif ($filtro=='artista'){
            $dischi = $pers->prelevaDischiperAutore($search);
            $generi = $pers->prelevaGeneri();
            if (count($dischi)!=0){
                $view->lista_prodotti($dischi, $session->isLogged(),null,$generi);
            }else{
                $view->message($session->isLogged(),"Non sono stati trovati alcuni dischi per l'artista: $search",'alla home','/lunova');
            }
        }
        else{
            header("Location: /lunova/RicercaDisco/ricerca");
        }

    }
}