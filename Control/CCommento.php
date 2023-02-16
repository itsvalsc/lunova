<?php

require_once 'Utility/autoload.php';
require_once("Foundation/FSessione.php");

/**
 * La classe CCommento viene utilizzata per la scrittura(e cancellazione) di commenti,
 * include la possibilità per l'artista di segnalare commenti (ipoteticamente volgari o non consoni) all'admin.
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
    public static function scriviCommento($id)
    {
        $sessione = new FSessione();
        $pm = FPersistentManager::getInstance();
        $cliente = $pm->load("FCliente", $sessione->leggi_valore('utente'));
        $disco = $pm->load("FDisco", $id);
        if (($sessione->leggi_valore('tipo_utente') == "ECliente")) {

            $view = new VCommento();
            $value = $view->getFormCommento();

            $valutazione = $value[0];
            $descrizione = $value[1];
            $data = (string)date("d/m/Y");

            $commento = new ECommento($cliente, $descrizione, $valutazione, $data, $disco[0]);

            $idC = $pm->store($commento);

            header('Location: /lunova/Product_list/mostra_prodotto/' . $id);
        } else {
            header('Location: /lunova/Ricerca/mostraHome');
        }
    }

    /**
     * Funzione richiamata quando un utente decide di cancellare il proprio commento.
     * Si possono avere diverse situazioni:
     * se l'utente non è loggato viene reindirizzato alla pagina di login perchè solo gli utenti registrati possono scrivere commenti
     * se l'utente è loggato : può cancellare il commento solo se scritto da lui
     * @param $id int id del commento
     * @throws SmartyException
     */
    static function cancellaCommento($id)
    {
        $sessione = new FSessione();
        $view = new VCommento();
        $user = $sessione->leggi_valore('utente');
        $tipo = $sessione->leggi_valore('tipo_utente');
        $pm = FPersistentManager::getInstance();
        if ($tipo == "ECliente") {
            $recensione = $pm->load("FCommento", $id);
            $utente = $pm->load("FUtente", $user);
            if ($utente->getUsername() == $recensione[0]->getUtente()->getUsername()) {
                $pm->delete("FCommento", $id, "id");
                header('Location: /lunova/Product_list/mostra_prodotto/' . $view->getIdDisco());
            } else {
                $sessione->cancella_valore('disco');
                header('Location: /lunova/Ricerca/mostraHome');
            }
        }
    }

    /**
     * Funzione richiamata dall'artista (autore del disco) per segnalare all'admin un commento (che potrà essere poi eliminato dal sito dall'admin)
     * @param $id int id del commento da segnalare
     */
    public function segnalaCommento($id)
    {
        $sessione = new FSessione();
        $view = new VCommento();
        $user = $sessione->leggi_valore('utente');
        $tipo = $sessione->leggi_valore('tipo_utente');
        $pm = FPersistentManager::getInstance();
        if ($tipo == "EArtista") {
            $pm->update_value("FRecensione", "segnalato", 1, "id", $id);
            header('Location: /lunova/Product_list/mostra_prodotto/' . $view->getIdDisco());
        } else {
            header('Location: /lunova/Ricerca/mostraHome');
        }
    }

}