<?php

require_once 'Smarty/smarty-lib/Smarty.class.php';

/** La classe FSession si occupa di gestire tutte le operazioni legate alla gestione delle sessioni PHP.
 *  @package Foundation
 */
class FSessione{

    private static $instance;

    /** Costruttore della classe FSession. */
    public function __construct() {
        if(!isset($_SESSION)) {
            session_start();
        }
    }

    public static function getInstance(): ?FSessione {
        if (self::$instance == null) {
            self::$instance = new FSessione();
        }
        return self::$instance;
    }

    /**
     * Metodo che verifica se un untente è loggato o meno
     * @return bool
     */
    public function isLogged(): bool {
        $identificato = false;
        if (isset($_COOKIE['PHPSESSID']) && isset($_SESSION['utente'])){
            $identificato = true;
        }
        return $identificato;
    }

    /**
     * Metodo per recuperare l'utente in sessione
     * @return mixed|null
     */
    public function getUtente(){
        if(isset($_SESSION['utente'])){
            $utente = $_SESSION['utente'];
            return unserialize($utente);
        }else{
            return null;
        }
    }

    /**
     * Metodo che permette di salvare l'utente in sessione
     * @param $utente
     */
    public function setUtente($utente){
        $user_ser = serialize($utente);
        $_SESSION['utente'] = $user_ser;
    }

    /**
     * Metodo che permette di eliminare i dati riguardanti la sessione di un utente
     * @return bool
     */
    public function logout(){
        if (isset($_COOKIE["PHPSESSID"])) {
            session_unset();
            session_destroy();
            setcookie("PHPSESSID", "", time() - 3600, "/");
            $bool = true;
        }
        return $bool;
    }

    /**
     * Metodi che vengono utilizzati per capire se l'utente in sessione è un cliente, artista o amministratore
     */
    public function isCliente(): bool {
        $utente = unserialize($_SESSION['utente']);
        if($utente->getLivello() == 'C'){
            $bool = true;
        }else{
            $bool = false;
        }
        return $bool;
    }

    public function isArtista(): bool {
        $utente = unserialize($_SESSION['utente']);
        if($utente->getLivello() == 'B'){
            $bool = true;
        }else{
            $bool = false;
        }
        return $bool;
    }

    public function isAdmin(): bool {
        $utente = unserialize($_SESSION['utente']);
        if($utente->getLivello() == 'A'){
            $bool = true;
        }else{
            $bool = false;
        }
        return $bool;
    }

    /**
     * Va ad eliminare la sessione, rimuovendone ogni traccia.
     * @return void
     */
    function close_session() {
        session_unset(); //Dealloca la RAM, cioè libera tutte le variabili di sessione attualmente registrate.
        session_destroy(); //Distrugge il file sul file system del server, cioè distrugge tutti i dati associati alla sessione corrente
        setcookie('PHPSESSID','',time()-3600); //Svuota il cookie su client dopo un'ora di inattività
    }
}
