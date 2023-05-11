<?php

/** La classe VRicerca si occupa dell'input-output per la ricerca di dischi, artisti */

class VRicerca
{
    private $smarty;

    /** Funzione che inizializza e configura smarty. */
    function __construct (){
        $this->smarty = StartSmarty::configuration();
    }

    /**
     * @param $name
     * @param $dati
     */
    public function setData($name, $dati)
    {
        $this->smarty->assign($name, $dati);
    }

    /**
     * @param $template
     */
    public function setTemplate($template)
    {
        $this->smarty->display($template);
    }

    /** Funzione che preleva il valore del pulsante "Aggiungi ai preferiti" */
    public function getPreferito(){
        $value = null;
        if (isset($_POST['pref']))
            $value = $_POST['pref'];
        return $value;
    }

    /**
     * Restituisce il valore del campo nome artista
     * Inviato con metodo post
     * @return string contenente il valore inserito dall'utente
     */
    public function getNomeArtista(): ?string
    {
        $value = null;
        if (isset($_POST['nomeArtista']))
                $value = $_POST['nomeArtista'];
        return $value;
    }

    /**
     * Metodo che restituisce l'id' del disco selezionato nella pagina personale
     * @return int
     */
    public function getIdDisco(): int
    { return $_POST['idDisco']; }

    /**
     * Restituisce il valore del campo nome disco
     * Inviato con metodo post
     * @return string contenente il valore inserito dall'utente
     */
    public function getNomeDisco(): ?string
    {
        $value = null;
        if (isset($_POST['nomeDisco']))
            $value = $_POST['nomeDisco'];
        return $value;
    }

    public  function getsearch(): ?string
    {
        $value = null;
        if (isset($_POST['search']))
            $value = $_POST['search'];
        return $value;
    }

    public  function getfiltro(): ?string
    {
        $value = null;
        if (isset($_POST['filtro']))
            $value = $_POST['filtro'];
        return $value;
    }


    /**
     * Restituisce il valore del campo genere di un disco
     * Inviato con metodo post
     * @return string contenente il valore inserito dall'utente
     */
    public function getGenere(): ?string
    {
        $value = null;
            if (isset($_POST['genere']))
                if($_POST['genere'] == "--Scegli il tipo--")
                    $value = "";
                else
                    $value = $_POST['genere'];
        return $value;
    }

    /**
     * Mostra i risultati del filtraggio della ricerca.
     * @param $result contiene i risultati ottenuti dal database
     * @param $tipo definisce il tipo di ricerca effettuata (Dischi/Sondaggi)
     * @param $nomeDisco nome del disco cercato
     * @param $genereDisco genere del disco
     * @throws SmartyException
     */
    public function mostraRisultati($result, $tipo, $nomeDisco, $genereDisco){

        $this->smarty->assign('array', $result);
        $this->smarty->assign('tipo', $tipo);
        if($tipo == "dischi"){
            $this->smarty->assign('nomeDisco', $nomeDisco);
            $this->smarty->assign('categoria', $genereDisco);
        }else{}

        $this->smarty->display('risultatiRicerca.tpl');
    }

    /**
     * Funzione utilizzata per visualizzare la homepage del sito
     * @param $tipo tipo di ricerca
     * @param $generi generi dei dischi
     * @param $sondaggiDischi sondaggi visibili all'utente(se connesso e se non è un artista)
     * @param $valutazione valutazione dei dischi
     */
    public function mostraHome($tipo, $generi, $sondaggiDischi, $valutazione){
        $this->smarty->assign('tipo',$tipo);
        $this->smarty->assign('generi',$generi);
        $this->smarty->assign('sondaggiDischi',$sondaggiDischi);
        $this->smarty->assign('valutazione',$valutazione);

        $this->smarty->display('homepage.tpl');
    }

    public function message($logged,$messaggio,$var_titolo,$var_url){
        $this->setData('message', $messaggio);
        $this->setData('var_titolo', $var_titolo);
        $this->setData('var_url', $var_url);

        $this->setData('logged', $logged);
        $this->setTemplate("message.tpl");
    }

    public function lista_prodotti($prod,$l,$num,$generi,$cli){
        $this->setData('logged', $l);
        $this->setData('product', $prod);
        $this->setData('num', $num);
        $this->setData('generi', $generi);
        $this->setData('isCliente', $cli);
        $this->setTemplate('products_list.tpl');
    }

    public function lista_utenti($prod,$l,$num, $cli){
        $this->setData('logged', $l);
        $this->setData('product', $prod);
        $this->setData('num', $num);
        $this->setData('isCliente', $cli);
        $this->setTemplate('user_list.tpl');
    }
}