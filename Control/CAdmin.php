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

    /**
     * Metodo che permetta all'admin di sospendere un utente settando l'attributo bannato relativo a quell'utente a 'true'
     * @param $email
     * @return null
     */
    public static function sospendiUtente(string $email)
    {
        $v = new VErrore();
        $sessione = FSessione::getInstance();
        $pm = FPersistentManager::getInstance();

        if ($sessione->isLogged() && $sessione->isAdmin()) {
            $ex = $pm->exist('FCliente',$email);
            if (!$ex){
                return $v->message_admin('errore: utente non trovato','alla home','Admin/usersadmin');
            }
            $ris = $pm->update_bannato($email,1);
            return header("Location: /lunova/Admin/usersadmin");

        } else {
            return header ("Location: /lunova");
        }
    }

    /**
     * Funzione utile per riattivae l'account di un utente che era stato precedentemente bannato.
     * @param $username string username identificativo univoco dell'utente
     **/
    public static function riattivaUtente(string $email)
    {
        $v = new VErrore();
        $sessione = FSessione::getInstance();
        $pm = FPersistentManager::getInstance();

        if ($sessione->isLogged() && $sessione->isAdmin()) {
            $ex = $pm->exist('FCliente',$email);
            if (!$ex){
                return $v->message_admin('errore: utente non trovato','alla home','Admin/usersadmin');
            }
            $ris = $pm->update_bannato($email,0);
            return header("Location: /lunova/Admin/usersadmin");
        } else {
            return header ("Location: /lunova/Admin/usersadmin");
        }
    }

    /**
     * Funzione utile per eliminare un commento segnalato.
     * @param $id_commento int identificativo del commento
     */
    public static function eliminaCommento($id_commento,$id_notifica=null)
    {
        $v = new VErrore();
        $sessione = FSessione::getInstance();
        $pm = FPersistentManager::getInstance();
        if ($sessione->isLogged() && $sessione->isAdmin()) {
            if (!$pm->exist('FCommento',$id_commento)){
                $pm->delete("FNotifiche",$id_notifica);
                return $v->message_admin('Il commento è gia stato elimanto, la notifica verrà eliminata','alle notifiche','Admin/notifiche');
            }
            $pm->delete("FCommento", $id_commento);
            if($id_notifica!=null){
                if (!$pm->exist('FNotifiche',$id_notifica)){
                    return $v->message_admin('Impossibile trovare la notifica selezionata','alle notifiche',"Admin/notifiche");
                }
                $pm->delete("FNotifiche",$id_notifica);
            }
            header("Location: /lunova/Admin/notifiche");
        } else {
            header("Location: /lunova");
        }
    }

    /**
     * Metodo che permetta all'admin di eliminare una notifica
     * @param $id_notifica
     * @return null
     */
    public static function eliminaNotifica($id_notifica){
        $view = new VErrore();
        $sessione = FSessione::getInstance();
        $pm = FPersistentManager::getInstance();
        if ($sessione->isLogged() && $sessione->isAdmin()) {
            if ($id_notifica!=null){
                if (!$pm->exist('FNotifiche',$id_notifica)){
                    return $view->message_admin('Impossibile trovare la notifica selezionata','alle notifiche',"Admin/notifiche");
                }
                $pm->delete("FNotifiche",$id_notifica);
            }else{
                return $view->message_admin("Si è verificato un errore durante l'eliminazione della notifica", "alle notifiche","Admin/notifiche");
            }
            return header("Location: /lunova/Admin/notifiche");
        }
        else{
            return header("Location: /lunova");
        }
    }

    /**
     * Metodo che permette all'admin di ignorare una notifica relativa ad un commento
     * @param $id_notifica
     * @param $id_commento
     * @return null
     */
    public static function ignora($id_notifica,$id_commento){
        $view = new VErrore();
        $sessione = FSessione::getInstance();
        $pm = FPersistentManager::getInstance();
        if ($sessione->isLogged() && $sessione->isAdmin()) {
            if ($id_notifica!=null && $id_commento!=null){
                if($pm->exist('FNotifiche',$id_notifica)){
                    if (!$pm->exist('FCommento',$id_commento)){
                        $pm->delete("FNotifiche",$id_notifica);
                        return header("Location: /lunova/Admin/notifiche");
                    }
                    $commento = $pm->load('FCommento',$id_commento);
                    if ($commento != null){//caso in cui non esiste piu l utente
                        $commento->setSegnala(false);
                        $pm->update($commento);
                        $pm->delete("FNotifiche",$id_notifica);
                        return header("Location: /lunova/Admin/notifiche");
                    }else{
                        $pm->delete("FNotifiche",$id_notifica);
                        return header("Location: /lunova/Admin/notifiche");
                    }
                }else{
                    return $view->message_admin('Impossibile eseguire questa azione, notifica non trovata','alle notifiche',"Admin/notifiche");
                }
            }else{
                return header("Location: /lunova/Admin/notifiche");
            }
        }
        else{
            return header("Location: /lunova");
        }
    }

    /**
     * Metodo che ritorna la dashboard iniziale dell'admin, che mostra la lista degli utenti (artisti e clienti),
     * con la possibilità di effettuare delle azioni su di essi
     * @return void
     */
    public static function usersadmin(){
        $view = new VUsers();
        $pers = FPersistentManager::getInstance();
        $session = FSessione::getInstance();
        if ($session->isLogged() && $session->isAdmin()){
            $Cli = $pers->prelevaClienti();
            $Art = $pers->prelevaArtisti();
            $view->loadadmin($Cli,$Art);
        }
        else{
            header('Location: /lunova');
        }
    }

    /**
     * Metodo che mostra le notifiche dell'admin, divise in sezioni e per categorie
     * @return void
     */
    public static function notifiche(){
        $view = new VNotifiche();
        $pers = FPersistentManager::getInstance();
        $session = FSessione::getInstance();
        if($session->isLogged() && $session->isAdmin()){
            $alte = $pers->prelNotifAlte();
            $basse = $pers->prelNotifBasse();
            $sond = $pers->prelevaRichieste();
            return $view->show($alte,$basse, $sond);
        }
        else{
            return header('Location: /lunova');
        }

    }

    /**
     * Metodo che restituisce la schermata di login dell'admin
     * @return void
     */
    public static function login(){
        $session = FSessione::getInstance();
        if (!$session->isLogged()){
            $view = new VLogin();
            return $view->AdminLogin(false);
        }
        else{
            return header('Location: /lunova');
        }
    }

    /**
     * Metodo che permette all'admin di ricercare facilmente un utente partendo dal commento selezionato nelle notifiche
     * @param $idComm
     * @return void|null
     */
    public static function ricercaUtente($idComm){
        $err = new VErrore();
        $session = FSessione::getInstance();
        $pers = FPersistentManager::getInstance();
        if ($session->isLogged() && $session->isAdmin()){
            if (!$pers->exist('FCommento',$idComm)) {
                return $err->message_admin("Impossibile cercare l'utente: commento non trovato",'alle notifiche','Admin/notifiche');
            }
            $commento = $pers->load('FCommento',$idComm);
            if ($commento != null){
                $ut = $commento->getCliente()->getIdClient();
                return header ("Location: /lunova/Admin/usersadmin#$ut");
            }else{
                return $err->message_admin("Impossibile cercare l'utente: utente non trovato",'alle notifiche','Admin/notifiche');
            }
        }
        else{
            return header('Location: /lunova');
        }
    }

    public static function aggiungi(){
        $session = FSessione::getInstance();
        $view = new VProfile();
        if ($session->isLogged() && $session->isAdmin()){
            return $view->Aggiungi_admin();
        }
        else{
            return header('Location: /lunova');
        }
    }
    public static function aggiungi_admin(){
        $session = FSessione::getInstance();
        $pers = FPersistentManager::getInstance();
        $view = new VErrore();
        if ($session->isLogged() && $session->isAdmin()){
            $nome = $_POST['nome'];
            $cognome = $_POST['cognome'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $telefono = $_POST['telefono'];
            if ($pers->exist('FAdmin',$email)){
                return $view->message_admin('Email gia esistente','indietro','Admin/aggiungi');
            }
            $amm = new EAdmin($nome,$cognome,$email,$password,$telefono);
            $pers->store($amm);
            return $view->message_admin('Amministratore aggiunto con successo','alle impostazioni','Profile/Impostazioni');

        }
        else{
            return header('Location: /lunova');
        }
    }

    public static function ordini_admin(){
        $session = FSessione::getInstance();
        $pers = FPersistentManager::getInstance();
        if ($session->isLogged() && $session->isAdmin()){
            $view = new VAdmin();
            $ordini = $pers->LoadOrdini_totale_ADMIN();
            return $view->Ordini_Admin($ordini);
        }else{
            return header('Location: /lunova');
        }
    }

    public static function conferma($idOrd){
        $view = new VAdmin();
        $session = FSessione::getInstance();
        $pers = FPersistentManager::getInstance();
        if ($session->isLogged() && $session->isAdmin()){
            $pers->update_value('FOrdine',"Confermato",1,$idOrd);

            $ordini = $pers->LoadOrdini_totale_ADMIN();
            return $view->Ordini_Admin($ordini);
        }else{
            return header('Location: /lunova');
        }
    }




}