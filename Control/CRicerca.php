<?php

require_once "autoload.php";
require_once "Foundation/FSessione.php";

/**
 * La classe CRicerca implementa la funzionalità di ricerca
 */

class CRicerca
{
    /**@var CRicerca|null Variabile di classe che mantiene l'istanza della classe. */
    private static ?CRicerca $instance = null;

    /** Costruttore di classe. */
    private function __construct() {}

    /**
     * Restituisce l'istanza della classe.
     * @return CRicerca|null
     */
    public static function getInstance(): ?CRicerca
    {
        if (!isset(self::$instance)) {
            self::$instance = new CRicerca();
        }
        return self::$instance;
    }

    /**
     * Funzione utilizzata per mostrare all'utente la homepage del sito,
     * includendo o escludendo una serie d'informazioni in base se è connesso o meno
     */
    public function mostraHome()
    {
        $sessione = new FSessione();
        $pm = FPersistentManager::getInstance();
        $sondaggiCliente = null;

        if ($sessione->isLogged()) {
            $tipo = $sessione->leggi_valore("tipo_utente");
            if ($tipo == "EAdmin") {
                header('Location: /lunova/Admin/dashboardAdmin');
            }elseif ($tipo == "EUtente") {
                $sondaggiCliente = $pm->prelevaSondaggioInCorso();
            }
        } else {
            $tipo = "nouser";
        }

        $view = new VRicerca();
        //$view->mostraHome($tipo, $sondaggiCliente);
    }

    /**
     * Metodo di ricerca che permette la ricerca di dischi.
     * @throws SmartyException
     */
    public function ricerca()
    { //TODO:ricerca}
    }
}