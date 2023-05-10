<?php

/**
 * La classe CCommento viene utilizzata per la scrittura(e cancellazione) di commenti,
 * e le interazioni tra gli utenti con altri utenti e/o prodotti (es. votazione dei dischi).
 * @package Controller
 */

class CCommento
{
    /**
     * Funzione richiamata quando un cliente scrive un commento a un disco.
     * @param $id int id del Disco
     * @throws SmartyException
     */
    public static function scriviCommento()
    {
        $err = new VErrore();
        $sessione = FSessione::getInstance();
        $pm = FPersistentManager::getInstance();
        $num = null;
        if ($sessione->isLogged() && $sessione->isCliente()){
            $cliente = $sessione->getUtente();
            $elenco = $pm->prelevaCartItems($cliente->getIdClient());
            $num = count($elenco);
            $cli = true;
            $bannato = ($pm->load('FCliente',$cliente->getEmail()))->getBannato();
            if ($bannato){
                return $err->message(true,'Il tuo account è stato sospeso, non è possibile scrivere commenti','alla home','',$num,$cli);
            }
            $data = (string)date("c");
            $descrizione=$_POST['commento'];
            $id_disco=$_POST['disco'];
            $commento = new ECommento($cliente, $descrizione, $data, $id_disco);
            $pm->store($commento);
            return header('Location: /lunova/Products_list/mostra_prodotto/'.$id_disco);
        }else{
            return header('Location: /lunova/Errore/unathorized');
        }
    }

    /**
     * Funzione richiamata quando un utente decide di cancellare il proprio commento.
     * Si possono avere diverse situazioni:
     * se l'utente non è loggato viene reindirizzato alla pagina di login perchè solo gli utenti registrati possono scrivere commenti
     * se l'utente è loggato : può cancellare il commento solo se scritto da lui
     * @param $id string id del commento
     * @throws SmartyException
     */
    static function cancellaCommento($id,$disco)
    {
        $err = new VErrore();
        $sessione = FSessione::getInstance();
        $pm = FPersistentManager::getInstance();
        $num = null;
        if ($sessione->isLogged() && $sessione->isCliente()){
            $cliente = $sessione->getUtente();
            $elenco = $pm->prelevaCartItems($cliente->getIdClient());
            $num = count($elenco);
            $cli = true;
            $bannato = ($pm->load('FCliente',$cliente->getEmail()))->getBannato();
            if ($bannato){
                return $err->message(true,'Il tuo account è stato sospeso, non è possibile eliminare commenti','alla home','',$num,$cli);
            }
            $commento = $pm->load("FCommento", $id);
            if ($cliente->getUsername() == $commento->getCliente()->getUsername()) {
                $pm->delete("FCommento", $id);
                return header('Location: /lunova/Products_list/mostra_prodotto/'.$disco);
            }
        }
        return header('Location: /lunova/Products_list/mostra_prodotto/'.$disco);
    }

    /**
     * Funzione richiamata dagli utenti per segnalare all'admin un commento
     * (che potrà essere poi eliminato dal sito dall'admin)
     * @param $id string id del commento da segnalare
     */
    public static function segnalaCommento($id,$disco)
    {
        $err = new VErrore();
        $sessione = FSessione::getInstance();
        $pm = FPersistentManager::getInstance();
        $num = null;
        if ($sessione->isLogged()){
            if ($sessione->isCliente()){
                $cliente = $sessione->getUtente();
                $elenco = $pm->prelevaCartItems($cliente->getIdClient());
                $num = count($elenco);
                $cli = true;
                $bannato = ($pm->load('FCliente',$cliente->getEmail()))->getBannato();
                if ($bannato){
                    return $err->message(true,'Il tuo account è stato sospeso, non è possibile segnalare commenti','alla home','',$num,$cli);
                }
            }
            $commento = $pm->load('FCommento',$id);
            if(!$commento->isSegnalato()){
                $commento->setSegnala(true);
                $pm->update($commento);
                $t=$commento->getDescrizione();
                $notifica = new ENotifiche("Questo commento è stato segnalato. Testo: $t".". Id_Autore: ".$commento->getCliente()->getIdClient(),'bassa',$commento->getId());
                $pm->store($notifica);
                return header('Location: /lunova/Products_list/mostra_prodotto/' .$disco);
            }
            else{
                return header('Location: /lunova/Products_list/mostra_prodotto/' .$disco);
            }
        } else {
           return header('Location: /lunova/Errore/unathorized');

        }
    }

    /**
     * Metodo che permette di effettuare recensire il Disco tramite una votazione numerica ( star rate)
     * @return null
     */
    public static function votazioneDisco(){
        $disco = $_POST['disco'];
        $rating = $_POST['rate'];
        $err = new VErrore();
        $session = FSessione::getInstance();
        $pers = FPersistentManager::getInstance();
        $num = null;
        if ($session->isLogged() && $session->isCliente()){
            $utente = $session->getUtente();
            $elenco = $pers->prelevaCartItems($utente->getIdClient());
            $num = count($elenco);
            $cli = true;
            $bannato = ($pers->load('FCliente',$utente->getEmail()))->getBannato();
            if ($bannato){
                return $err->message(true,'Il tuo account è stato sospeso, non è possibile votare dischi','alla home','',$num,$cli);
            }
            $vot = new EVotazioneDisco($utente->getIdClient(),$disco,intval($rating));
            $pers->store($vot);
        }
        return header('Location: /lunova/Products_list/mostra_prodotto/' .$disco);
    }

    /**
     * Metodo che permette ad un cliente di mettere mi piace ad un commento
     * @param $comm
     * @param $disco
     * @return null
     */
    public static function votazioneCommento($comm,$disco){
        $err = new VErrore();
        $session = FSessione::getInstance();
        $pers = FPersistentManager::getInstance();
        $num = null;
        if ($session->isLogged() && $session->isCliente()){
            $utente = $session->getUtente();
            $elenco = $pers->prelevaCartItems($utente->getIdClient());
            $num = count($elenco);
            $cli = true;
            $bannato = ($pers->load('FCliente',$utente->getEmail()))->getBannato();
            if ($bannato){
                return $err->message(true,'Il tuo account è stato sospeso, non è possibile mettere mi piace ai commenti','alla home','',$num,$cli);
            }
            $vot = new EVotazioneCommento($utente->getIdClient(),$disco,$comm);
            $pers->store($vot);
        }
        return header('Location: /lunova/Products_list/mostra_prodotto/' .$disco);
    }

    /**
     * Metodo che permette ad un cliente di eliminare il 'mi piace' ad un commento a cui lo aveva precedentemente messo
     * @param $comm
     * @param $disco
     * @return null
     */
    public static function eliminaMP($comm,$disco){
        $err = new VErrore();
        $session = FSessione::getInstance();
        $pers = FPersistentManager::getInstance();
        $num = null;
        if ($session->isLogged() && $session->isCliente()){
            $utente = $session->getUtente();
            $elenco = $pers->prelevaCartItems($utente->getIdClient());
            $num = count($elenco);
            $cli = true;
            $bannato = ($pers->load('FCliente',$utente->getEmail()))->getBannato();
            if ($bannato){
                return $err->message(true,'Il tuo account è stato sospeso, non è possibile togliere mi piace','alla home','',$num,$cli);
            }
            $pers->delete('FVotazioneCommento',$utente->getIdClient(),$comm);
        }
        return header('Location: /lunova/Products_list/mostra_prodotto/' .$disco);
    }

}