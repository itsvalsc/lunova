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
    private static ?CCommento $instance = null;

    private function __construct() {}

    /**
     * Restituisce l'istanza della classe.
     * @return CCommento|null
     */
    public static function getInstance(): CCommento
    {
        if (!(self::$instance instanceof self)) {
            self::$instance = new CCommento();
        }
        return self::$instance;
    }

    /**
     * Funzione richiamata quando un cliente scrive un commento a un disco.
     * @param $id int id del Disco
     * @throws SmartyException
     */
    public static function scriviCommento()
    {
        $sessione = FSessione::getInstance();
        $pm = FPersistentManager::getInstance();
        if ($sessione->isLogged() || $sessione->isCliente()){
            $cliente = $sessione->getUtente();
            $data = (string)date("Y/m/d");
            $descrizione=$_POST['commento'];
            $id_disco=$_POST['disco'];
            $valutazione=0;
            $commento = new ECommento($cliente, $descrizione, $valutazione, $data, $id_disco);
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
    static function cancellaCommento($id)
    {
        $sessione = new FSessione();
        $view = new VCommento();
        $pm = FPersistentManager::getInstance();
        if ($sessione->isLogged() || $sessione->isCliente()){
            $cliente = $sessione->getUtente();
            $commento = $pm->load("FCommento", $id);
            $utente = $pm->load("FCliente", $cliente);
            if ($utente->getUsername() == $commento[0]->getUtente()->getUsername()) {
                $pm->delete("FCommento", $id, "id");
                header('Location: /lunova/Product_list/mostra_prodotto/' . $view->getIdDisco());
            } else {
                $sessione->cancella_valore('disco');
                header('Location: /lunova/Ricerca/mostraHome');
            }
        }
    }

    /**
     * Funzione richiamata dall'artista (autore del disco) per segnalare all'admin un commento
     * (che potrà essere poi eliminato dal sito dall'admin)
     * @param $id string id del commento da segnalare
     */
    public function segnalaCommento($id)
    {
        $sessione = new FSessione();
        $view = new VCommento();
        $pm = FPersistentManager::getInstance();
        if ($sessione->isLogged() || ($sessione->isArtista())){
            $pm->update_value("FCommento", "segnalato", 1, "id", $id);
            header('Location: /lunova/Product_list/mostra_prodotto/' . $view->getIdDisco());
        } else {
            header('Location: /lunova/Ricerca/mostraHome');
        }
    }

}