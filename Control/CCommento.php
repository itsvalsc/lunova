<?php

require_once 'Utility/autoload.php';
require_once("Foundation/FSessione.php");

/**
 * La classe CCommento viene utilizzata per la scrittura(e cancellazione) di commenti,
 * include la possibilità per l'artista di segnalare commenti (volgari o non consoni) all'admin.
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
    { //todo:la data deve essere cambiata in datetime sul db e togliere la colonna voto nei commenti
        $sessione = FSessione::getInstance();
        $pm = FPersistentManager::getInstance();
        if ($sessione->isLogged() || $sessione->isCliente()){
            $cliente = $sessione->getUtente();
            $data = (string)date("c");
            $descrizione=$_POST['commento'];
            $id_disco=$_POST['disco'];
            $commento = new ECommento($cliente, $descrizione, $data, $id_disco);
            $pm->store($commento);
            header('Location: /lunova/Products_list/mostra_prodotto/'.$id_disco);
        }else{
            header('Location: /lunova/Errore/unathorized');
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
        $sessione = FSessione::getInstance();
        $pm = FPersistentManager::getInstance();
        if ($sessione->isLogged() || $sessione->isCliente()){
            $cliente = $sessione->getUtente();
            $commento = $pm->load("FCommento", $id);
            if ($cliente->getUsername() == $commento->getCliente()->getUsername()) {
                $pm->delete("FCommento", $id);
                header('Location: /lunova/Products_list/mostra_prodotto/'.$disco);
            }
        }
        header('Location: /lunova/Products_list/mostra_prodotto/'.$disco);
    }

    /**
     * Funzione richiamata dall'artista (autore del disco) per segnalare all'admin un commento
     * (che potrà essere poi eliminato dal sito dall'admin)
     * @param $id string id del commento da segnalare
     */
    public static function segnalaCommento($id,$disco)
    {
        $sessione = FSessione::getInstance();
        $pm = FPersistentManager::getInstance();
        if ($sessione->isLogged()){
            //$pm->update_value("FCommento", "segnalato", 1, "id", $id);
            $commento = $pm->load('FCommento',$id);
            $commento->setSegnala(true);
            $pm->update($commento);
            header('Location: /lunova/Products_list/mostra_prodotto/' .$disco);
        } else {
            header('Location: /lunova/Ricerca/mostraHome');
        }
    }

}