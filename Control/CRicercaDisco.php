<?php
class CRicercaDisco{
    public static function index(){
        $viewex = new VHome();
        $var = '';
        $logged= false;
        $session = FSessione::getInstance();
        if ($session->isLogged()){
            $ut = $session->getUtente();
            $logged = true;
            $var = $ut->getUsername();
        }

        $viewex->ShowIndex($logged,$var);
    }

    public static function newDisc(){
        $view = new VNewDisc();
        $pers = FPersistentManager::getInstance();
        $session = FSessione::getInstance();

        if ($session->isLogged() && $session->isArtista()){
            $elenco = $pers->prelevaGeneri();
            $view->new(true,$elenco);
        }else{
            $view->message($session->isLogged(),'impossibile accedere in questa sezione', 'homepage','RicercaDisco/index');
        }
    }

    public static function ricerca(){
        $view = new VRicerca();
        $pers = FPersistentManager::getInstance();
        $session = FSessione::getInstance();
        $filtro = $view->getfiltro();
        $search = $view->getsearch();
        if ($filtro=='disco'){
            $dischi = $pers->prelevaDischiperTitolo($search);
            if (count($dischi)!=0){
                $view->lista_prodotti($dischi,$session->isLogged());
            }else{
                $view->message($session->isLogged(),'Disco non trovato','alla home','/lunova');
            }
        }
        elseif ($filtro=='genere'){
            $dischi = $pers->prelevaDischiperGen($search);
            if (count($dischi)!=0){
                $view->lista_prodotti($dischi,$session->isLogged());
            }else{
                $view->message($session->isLogged(),'Disco non trovato','alla home','/lunova');
            }
        }
        elseif ($filtro=='artista'){

        }
        else{
            header("Location: /lunova/RicercaDisco/ricerca");
        }
        //$search = $_POST['search'];
        //$session = FSessione::getInstance();
        //$view->message($session->isLogged(),$search,'alla ricerca','Products_list/elenco_dischi');
    }
}