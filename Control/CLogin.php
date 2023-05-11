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

    /**
     * Metodo che mostra la pagina per effettuare il login per il cliente o per l'artista
     * @return void
     */
    public static function login(){
        $view = new VLogin();
        $session = FSessione::getInstance();
        if ($session->isLogged()){
            header("Location: /lunova");
        }else{
            $view->Login($session->isLogged());
        }
    }

    /**
     * Metodo che mostra la pagina per effettuare il login per gli amministratori
     * @return void
     */
    public static function Admin(){
        $view = new VLogin();
        $session = FSessione::getInstance();
        if ($session->isLogged()){
            header("Location: /lunova");
        }else{
            $view->AdminLogin($session->isLogged());
        }
    }



    /**
     * Effettua il logout e chiude la sessione
     */
    public static function logout(){
        $view = new VHome();
        $session = FSessione::getInstance();
        $b = $session->logout();
        header('Location: /lunova');

    }

    /**
     * Metodo che mostra la schermata di registrazione dei clienti o degli artisti
     * @return void
     */
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
        $session = FSessione::getInstance();
        $class = self::$bindClass[$v->IsArtista()];
        if ($pm->exist($class, $email)) {
            $utente = $pm->load($class, $email);
            if ( hash('sha256',$password) == $utente->getPassword() ) {
                $session->setUtente($utente);
                $session->setCarrello(new ECarrello());
                return header('Location: /lunova');
            } else {
                $v->message(false,'password errata','Login','Login/login');
            }
        }
        else {
            $v->message(false,'utente non trovato','Login','Login/login');
        }
    }

    /**
     * Metodo che gestisce il login dell'admin (controllo credenziali)
     * @return void|null
     */
    public static function verificaLoginAdmin(){
        $v = new VLogin();
        $err = new VErrore();
        $email = $v->getEmail();
        $password = $v->getPwd();
        $pm = FPersistentManager::getInstance();
        $gs = FSessione::getInstance();
        if ($pm->exist('FAdmin', $email)) {
            $admin = $pm->load('FAdmin', $email);
            if (hash('sha256',$password) == $admin->getPassword()) {
                $gs->setUtente($admin);
                return header("Location: /lunova/Admin/usersadmin");
            } else {
                return $err->message_admin('password errata','Login','Login/Admin');
            }
        }else {
            return $err->message_admin('Utente non trovato','Login','Login/Admin');
        }
    }

}
