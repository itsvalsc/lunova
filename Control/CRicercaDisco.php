<?php
class CRicercaDisco{
    public static function index(){
        $viewex = new VHome();
        $var = '';
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
                if ($session->carrelloIsSet()){   //se esiste il carrello in sessione
                    $elenco = $pers->prelevaCartItems($session->getCarrello()->getId());
                    $num = count($elenco);
                }
                else{   //se non esiste il carrello in sessione
                    $car = $pers->prelevaCarrelloCorrente($utente);
                    if ( $car !=null){   //se esiste il carrello sul db relativo all utente
                        $session->setCarrello($car);
                        $elenco = $pers->prelevaCartItems($session->getCarrello()->getId());
                        $num = count($elenco);
                    }
                    else{   //se non esiste il carrello sul db relativo all utente
                        $car = new ECarrello($utente);
                        $pers->store($car);
                        $session->setCarrello($car);
                        $num = 0;
                    }
                }
            }
        }
        $viewex->ShowIndex($logged,$var, $num);
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

    public static function ricerca(){
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
            if (count($dischi)!=0){
                $view->lista_prodotti($dischi,$session->isLogged(),$num);
            }else{
                $view->message($session->isLogged(),'Disco non trovato','alla home','/lunova');
            }
        }
        elseif ($filtro=='genere'){
            $dischi = $pers->prelevaDischiperGen($search);
            if (count($dischi)!=0){
                $view->lista_prodotti($dischi,$session->isLogged(),null);
            }else{
                $view->message($session->isLogged(),'Non è stato trovato nessun disco per questa categoria','alla home','/lunova');
            }
        }
        elseif ($filtro=='artista'){
            $dischi = $pers->prelevaDischiperAutore($search);
            if (count($dischi)!=0){
                $view->lista_prodotti($dischi, $session->isLogged(),null);
            }else{
                $view->message($session->isLogged(),"Non sono stati trovati alcuni dischi per l'artista: $search",'alla home','/lunova');
            }
        }
        else{
            header("Location: /lunova/RicercaDisco/ricerca");
        }

    }
}