<?php

/**
 * La classe VCommento si occupa dell'input-output per la scrittura di commenti
 * @package View
 */

class VCommento
{//todo: non utilizzata

    private $smarty;

    /** Funzione che inizializza e configura smarty. */
    public function __construct()
    { $this->smarty = StartSmarty::configuration(); }

    /**
     * Restituisce la descrizione del commento che si vuole scrivere
     * Inviato con metodo post
     * @return string
     */
    public function getDescrizione(): ?string
    {
        $value = null;
        if (isset($_POST['descrizione']))
            $value = $_POST['descrizione'];
        return $value;
    }

    /**
     * Restituisce l'id del disco che è stato commentatodella risposta ad una recensione
     * Inviato con metodo post
     * @return int
     */
    public function getIdDisco(): ?int
    {
        $value = null;
        if (isset($_POST['idDisco']))
            $value = $_POST['idDisco'];
        return $value;
    }



}