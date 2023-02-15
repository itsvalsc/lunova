<?php
class CLogin{

    private static array $bindClass = [true=>'FArtista',false=>'FCliente'];

    /**
     * Va a riconoscere il browser tramite il 'PHPSESSID'
     * @return bool
     */
    public static function isLogged(){
        $login = false;
        if (isset($_COOKIE['PHPSESSID'])){
            if (FSessione::status() == PHP_SESSION_NONE){
                FSessione::start();
            }
        }
        if(FSessione::getUtente()!=null) {
            $login = true;
        }
        return $login;
    }

    public static function login(){
        $view = new VLogin();
        $session = FSessione::getInstance();
        if ($session->isLogged()){
            header("Location: /lunova");
        }else{
            $view->Login(false);
        }


    }

    /**
     * Effettua il logout e chiude la sessione
     */
    public static function logout(){
        $view = new VHome();
        $session = FSessione::getInstance();
        $b = $session->logout();
        $view->ShowIndex(false,'');

    }

     //TODO : funzione verifica login da fare dopo aver scritto il persistent manager

    public static function prova(){
        $viewex = new VLogin();
        FSessione::start();
        //$l = 'login';
        $viewex->Login();
    }

    public static function Signin(){

        $session = FSessione::getInstance();
        if ($session->isLogged()){
            $view = new VHome();
            $ut = $session->getUtente();
            $logged = true;
            $var = $ut->getUsername();
            $view->ShowIndex($logged,$var);
        }else{
            $view = new VLogin();
            $l = false;
            $view->Signin($l);
        }

    }

    /**
     * Metodo che gestisce il login utente (controllo credenziali)
     */
    public static function verificaLogin()
    {
        $v = new VLogin();
        $email = $v->getEmail();
        $password = $v->getPwd();
        $pm = FPersistentManager::getInstance();
        $gs = FSessione::getInstance();
        $class = self::$bindClass[$v->IsArtista()];
        if ($pm->exist($class, $email)) {
            $utente = $pm->load($class, $email);
            if ($password == $utente->getPassword()) {
                $gs->setUtente($utente);
                $v->ShowIndex(true,$utente->getUsername());
                //header("Location: ".$GLOBALS['path'] ."GestioneSchermate/recuperaHome");
            } else {
                $v->message(false,'password errata','Login','Login/login');
                //header("Location: ".$GLOBALS['path'] ."GestioneSchermate/recuperaLogin");
            }
        }
        else {
            $v->message(false,'utente non trovato','Login','Login/login');
            //header("Location: ".$GLOBALS['path']."GestioneSchermate/recuperaLogin");
        }
    }

}
