<?php

require_once "Utility/autoload.php";
require_once "Foundation/FSessione.php";

/**
 * La classe CAdmin implementa funzionalità per l'admin della piattaforma, al quale è consentito:
 * * bannare/attivare utenti;
 * * eliminare/ripristinare commenti segnalati;
 * * cercare commenti e utenti.
 * @package Controller
 */

class CAdmin{

    private static ?CAdmin $instance = null;

    private function __construct() {}

    /**
     * Restituisce l'istanza della classe.
     * @return CAdmin|null
     */
    public static function getInstance(): ?CAdmin
    {
        if (!isset(self::$instance)) {
            self::$instance = new CAdmin();
        }
        return self::$instance;
    }

    /**
     * Metodo che mostra la dashboard di controllo del admin.
     * @throws SmartyException
     */
    public static function dashboardAdmin()
    {
        $sessione = FSessione::getInstance();
        $pm = FPersistentManager::getInstance();
        $view = new VAdmin();
        if ($sessione->isLogged() && ($sessione->isAdmin())) {

            //loadUtenti --> Separo in Utenti attivi e Bannati
            $utentiAttivi = $pm->load("FCliente", "stato");
            $utentiA = array();
            if(!is_array($utentiAttivi) && $utentiAttivi != null){
                $utentiA[0] = $utentiAttivi;
            }else if(!empty($utentiAttivi)){
                $utentiA = $utentiAttivi;
            }

            $utentiBannati = $pm->load("FCliente", "stato");
            $utentiB = array();
            if(!is_array($utentiBannati) && $utentiBannati != null){
                $utentiB[0] = $utentiBannati;
            }else if(!empty($utentiBannati)){
                $utentiB = $utentiBannati;
            }

            //loadCommenti segnalati
            $comSegnalati = $pm->load("FCommento", "segnalato");

            //loadArtisti
            $artisti = $pm->prelevaArtisti();
            $dischi = $pm->prelevaDischiperAutore("FDisco");

            $view->HomeAdmin($utentiA, $utentiB, $artisti, $dischi,$comSegnalati);
        } else {
            header('Location: /lunova/Ricerca/mostraHome');
        }
    }

    /**
     * Funzione utile per cambiare lo stato di un utente (nel caso specifico porta la visibilità a false).
     * @param $username string Username dell'utente da bannare sul sito, impedendogli di scrivere ulteriori commenti.
     **/
    public static function sospendiUtente(string $email)
    {
        //$v = new VErrore();
        $sessione = FSessione::getInstance();
        $pm = FPersistentManager::getInstance();

        if ($sessione->isLogged() && $sessione->isAdmin()) {
            $ex = $pm->exist('FCliente',$email);
            $ris = $pm->update_bannato($email,1);
            header("Location: /lunova/Admin/usersadmin");
            //header ("Location: /lunova/Admin/users");
            //$v->message(true,$ris,'','');
        } else {
            //header("Location: /lunova/Ricerca/mostraHome");
            header ("Location: /lunova/Admin/users");
        }
    }

    /**
     * Funzione utile per cancellare un utente già bannato.
     * @param $username string username identificativo univoco dell'utente
     **/
    public static function riattivaUtente(string $email)
    {
        //$v = new VErrore();
        $sessione = FSessione::getInstance();
        $pm = FPersistentManager::getInstance();

        if ($sessione->isLogged() && $sessione->isAdmin()) {
            $ex = $pm->exist('FCliente',$email);
            $ris = $pm->update_bannato($email,0);
            header("Location: /lunova/Admin/usersadmin");
            //$v->message(true,$ris,'','');
        } else {
            header ("Location: /lunova/Admin/usersadmin");
        }
    }

    /**
     * Funzione utile per eliminare un commento segnalato.
     * @param $id_commento int identificativo del commento
     */
    public static function eliminaCommento(int $id_commento)
    {
        $sessione = FSessione::getInstance();
        $pm = FPersistentManager::getInstance();

        if ($sessione->isLogged() && $sessione->isAdmin()) {
            $pm->delete("FCommento", $id_commento, "id");
            header("Location: /lunova/Admin/usersadmin");
        } else {
            header("Location: /lunova/");
        }
    }

    /**
     * Funzione utile per togliere il segnalato a un commento segnalato.
     * @param $id_commento int identificativo del commento
     */
    public static function reinserisciCommento(int $id_recensione)
    {
        $sessione = FSessione::getInstance();
        $pm = FPersistentManager::getInstance();

        if ($sessione->isLogged() && $sessione->isAdmin()) {
            $pm->update_value("FRecensione", "segnalato", false, "id", $id_recensione);
            header("Location: /lunova/Admin/usersadmin");
        } else {
            header("Location: /lunova/");
        }
    }

    /*
     * questo metodo è per quando qualcuno clicca su un artista
     * bisogna crearne uno diverso se si tratta del suo stesso profilo
     * */

    public static function users(string $id){
        $view = new VUsers();
        $pers = FPersistentManager::getInstance();
        $session = FSessione::getInstance();
        $l = true;
        $Art = $pers->ArtistaFromID($id);
        $elenco = $pers->prelevaDischiperIDAutore($id);
        $numero = count($elenco);
        $view->load($l,$Art, $elenco, $numero);
    }

    public static function usersadmin(){
        $view = new VUsers();
        $pers = FPersistentManager::getInstance();
        $session = FSessione::getInstance();
        if ($session->isLogged() && $session->isAdmin()){
            $Cli = $pers->prelevaClienti();
            $Art = $pers->prelevaArtisti();
            $view->loadadmin(true,$Cli,$Art);
        }
        else{
            header('Location: /lunova');
        }

    }

    public static function notifiche(){
        $view = new VNotifiche();
        $pers = FPersistentManager::getInstance();
        $session = FSessione::getInstance();
        if($session->isLogged() && $session->isAdmin()){
            $alte = $pers->prelNotifAlte();
            $basse = $pers->prelNotifBasse();
            $sond = $pers->prelevaRichieste();
            $view->show($alte,$basse, $sond);
        }

    }


    public static function login(){
        $view = new VLogin();
        $view->AdminLogin(false);
    }

    public static function EliminaC($email){
        $view = new VAdmin();
        $l = true;
        $pers = FPersistentManager::getInstance();
        $elimina = $pers->delete('FCliente',$email);
        header ("Location: /lunova/Admin/users");
    }
    public static function EliminaA($email){
        $view = new VAdmin();
        $l = true;
        $pers = FPersistentManager::getInstance();
        $elimina = $pers->delete('FArtista',$email);
        header ("Location: /lunova/Admin/users");
    }

}