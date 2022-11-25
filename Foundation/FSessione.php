<?php
class FSessione{

    /**
     *
     */
    public static function start(){
        session_start();
    }

    /**
     *
     */
    public static function unset(){
        session_unset();
    }

    /**
     *
     */
    public static function destroy(){
        session_destroy();
    }

    /**
     */
    public static function status(){
        return session_status();
    }

    /**
     * @return mixed|null
     */
    public static function getUtente(){
        if(isset($_SESSION['utente'])){
            return $_SESSION['utente'];
        }else{
            return null;
        }
    }

    /**
     * @param $utente
     */
    public static function setUtente($utente){
        $_SESSION['utente'] = $utente;
    }

}
