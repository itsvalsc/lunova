<?php

/**
 * La classe VAdmin si occupa dell'input-output per la sezione privata dell'admin
 * @package View
 */
class VAdmin
{
    private $smarty;

    /** Funzione che inizializza e configura smarty. */
    function __construct ()
    { $this->smarty = StartSmarty::configuration(); }

    /**
     * Restituisce l'email dell'utente da bannare/riattivare dal campo hidden input
     * Inviato con metodo post
     * @return string contenente l'email dell'utente
     */
    function getEmail(): ?string
    {
        $value = null;
        if (isset($_POST['email']))
            $value = $_POST['email'];
        return $value;
    }

    function getGenere(): ?string
    {
        $value = null;
        if (isset($_POST['genere']))
            $value = $_POST['genere'];
        return $value;
    }

    function getDescrizione(): ?string
    {
        $value = null;
        if (isset($_POST['descrizione']))
            $value = $_POST['descrizione'];
        return $value;
    }

    /**
     * Restituisce la username dell'utente da bannare/riattivare dal campo hidden input
     * Inviato con metodo post
     * @return string contenente l'email dell'utente
     */
    function getUsername(): ?string
    {
        $value = null;
        if (isset($_POST['username']))
            $value = $_POST['username'];
        return $value;
    }

    /**
     * Restituisce l'id del commento da eliminare (proviene dal campo input hidden)
     * Inviato con metodo post
     * @return string contenente l'id del commento
     */
    function getId(): ?string
    {
        $value = null;
        if (isset($_POST['valore']))
            $value = $_POST['valore'];
        return $value;
    }

    /**
     * Funzione che permette di visualizzare la pagina home dell'admin (contenente tutti gli utenti della piattaforma),divisi in attivi e bannati.
     * @param $utentiAttivi array di utenti attivi
     * @param $utentiBannati array di utenti bannati
     * @param $artisti array di artisti
     * @param $commenti array dei commenti segnalati
     * @throws SmartyException
     */
    public function HomeAdmin($utentiAttivi, $utentiBannati, $artisti, $dischi, $commenti) {
        $this->smarty->assign('utentiAttivi',$utentiAttivi);
        $this->smarty->assign('utentiBannati',$utentiBannati);
        $this->smarty->assign('artisti',$artisti);
        $this->smarty->assign('dischi',$dischi);
        $this->smarty->assign('commenti',$commenti);
        $this->smarty->display('admin.tpl');
    }


    public function Ordini_Admin($l, $ordine) {
        $this->smarty->assign('logged',$l);
        $this->smarty->assign('ordine',$ordine);
        $this->smarty->display('ordine_admin.tpl');
    }

}