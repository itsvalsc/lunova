<?php
class CLogin{

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
        $viewex = new VLogin();
        //FSessione::start();
        $l = true;
        $viewex->Login($l);
        /*
        if(static::isLogged()){
            //TODO: mettere la view da utente loggato
        }else{
            //TODO: view login
        }
        */
    }

    /**
     * Effettua il logout e chiude la sessione
     */
    public static function logout(){
        FSessione::start();
        FSessione::unset();
        FSessione::destroy();
        header('Location: /lunova/');
    }

     //TODO : funzione verifica login da fare dopo aver scritto il persistent manager

    public static function prova(){
        $viewex = new VLogin();
        FSessione::start();
        //$l = 'login';
        $viewex->Login();
    }

    public static function Signin(){
        $viewex = new VLogin();
        FSessione::start();
        $l = true;
        $viewex->Signin($l);
    }

}
