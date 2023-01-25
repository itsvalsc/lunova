<?php

require_once 'Smarty/smarty-lib/Smarty.class.php';

class FSessione{

    /**
     * Costruttore della classe FSession.
     */
    public function __construct()
    {
        if(!isset($_SESSION))
        {session_start();}
    }

    public static function getInstance(): ?FSessione {
        if (!isset(self::$instance)){
            self::$instance = new FSessione();
        }
        return self::$instance;
    }

    public static function start(){
        session_start();
    }

    /**
     * Metodo che verifica se un untente è loggato o meno
     * @return bool
     */
    public function isLogged(): bool {
        $identificato = false;
        if (isset($_COOKIE['PHPSESSID']) && isset($_SESSION['user'])){
            $identificato = true;
        }
        return $identificato;
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
     * Metodo che restituisce una stringa identificativa dell'utente
     * per poter mostrare una NavBar personalizzata: i risultati che possono uscire
     * da questo metodo sono: "non loggato", "admim", "username artista" o "username cliente"
     */
    public static function UserNavBar():string {
        if(FSessione::isLogged()) {
            $utente = unserialize(($_SESSION['utente']));
            if ($utente->getLivello() == "A") {
                $user = "admin";
            }
            elseif ($utente->getLivello() == "B") {
                $user = "artista";
            }
            elseif ($utente->getLivello() == "C") {
                $user = "cliente";
            }
        } else { $user = null; }
        return $user;
    }

    /**
     * @param $utente
     */
    public static function setUtente($utente){
        $_SESSION['utente'] = $utente;
    }

    /**
     * Imposta il valore di un elemento dell'array globale $_SESSION identificato dalla chiave
     * @param $chiave mixed
     * @param $valore mixed
     * @return void
     */
    function imposta_valore($chiave, $valore) {
        $_SESSION[$chiave] = $valore;
    }

    /**
     * Metodo utilizzato per accedere all'elemento di $_SESSION identificato dalla propria chiave
     * @param $chiave mixed identifica l'elemento del array
     */
    function leggi_valore($chiave) {
        $value = false;
        if (isset($_SESSION[$chiave])) {
            $value = $_SESSION[$chiave];
        }
        return $value;
    }

    /**
     * Metodo che va a svuotare uno degli elementi del vettore $_SESSION, identificato dalla sua chiave
     * @param $chiave mixed
     * @return void
     */
    function cancella_valore($chiave): void{
        unset($_SESSION[$chiave]);
    }

    public static function unset(){
        session_unset();
    }

    public static function destroy(){
        session_destroy();
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

    /** */
    public static function status(){
        return session_status();
    }
}
