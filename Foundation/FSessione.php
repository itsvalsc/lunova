<?php

require_once 'Smarty/smarty-lib/Smarty.class.php';

class FSessione{

    private static $instance;

    /**
     * Costruttore della classe FSession.
     */
    public function __construct()
    {
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
     * Metodo che permette ci eliminare i dati riguardanti la sessione di un utente
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
     * Metodo che permette di salvare l'utente in sessione
     * @param $utente
     */
    public function setUtente($utente){
        $user_ser = serialize($utente);
        $_SESSION['utente'] = $user_ser;
    }

    /**
     * Imposta il valore di un elemento dell'array globale $_SESSION identificato dalla chiave
     * @param $chiave mixed
     * @param $valore mixed
     * @return void
     */
    function imposta_valore($chiave, $valore) {
        $val = serialize($valore);
        $_SESSION[$chiave] = $val;
    }

    /**
     * Metodo utilizzato per accedere all'elemento di $_SESSION identificato dalla propria chiave
     * @param $chiave mixed identifica l'elemento del array
     */
    function leggi_valore($chiave) {
        if (isset($_SESSION[$chiave])) {
            $value = unserialize($_SESSION[$chiave]);
        }else{
            $value=false;
        }
        return $value;
    }


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
    public function carrelloIsSet(): bool {
        if (isset($_SESSION['carrello'])){
            $bool = true;
        }else{
            $bool=false;
        }
        return $bool;
    }

    public function setCarrello($carrello){
        $val = serialize($carrello);
        $_SESSION['carrello'] = $val;
    }

    public function getCarrello(){
        if(isset($_SESSION['carrello'])){
            $carrello = $_SESSION['carrello'];
            return unserialize($carrello);
        }else{
            return null;
        }
    }


    public static function start(){
        session_start();
    }
    /**
     * Metodo che inizializza una sessione.
     */
    private function iniziaSessione(){
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
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
