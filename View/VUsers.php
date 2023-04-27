<?php
class VUsers{

    private $smarty;

    /**
     * VLogin constructor.
     */
    public function __construct(){
        $this->smarty = StartSmarty::configuration();
    }
    /**
     * @param $name
     * @param $dati
     */
    public function setData($name,$dati){
        $this->smarty->assign($name,$dati);
    }
    /**
     * @param $template
     */
    public function setTemplate($template){
        $this->smarty->display($template);
    }

    public function load($l,$s, $elenco, $num, $controllo,$numComm, $cli){
        //$this->setData('user', $l);
        $this->setData('product', $elenco);
        $this->setData('logged', $l);
        $this->setData('artista', $s);
        $this->setData('numero', $num);
        $this->setData('numComm', $numComm);
        $this->setData('controllo', $controllo);
        $this->setData('isCliente', $cli);
        $this->setTemplate("profile.tpl");
    }

    public function load_external($l,$num,$s, $elenco, $numero,$numComm, $cli){
        //$this->setData('user', $l);
        $this->setData('product', $elenco);
        $this->setData('num', $num);
        $this->setData('logged', $l);
        $this->setData('artista', $s);
        $this->setData('numero', $numero);
        $this->setData('numComm', $numComm);
        $this->setData('isCliente', $cli);
        $this->setTemplate("profile_seen_art.tpl");
    }

    public function load_cl($l,$num,$ut,$vot,$numComm,$commenti,$nmp,$tot_nmp,$nome_dischi,$cli){
        $this->setData('cliente', $ut);
        $this->setData('num', $num);
        $this->setData('logged', $l);
        $this->setData('votazioni', $vot);
        $this->setData('numComm', $numComm);
        $this->setData('commenti', $commenti);
        $this->setData('nmp', $nmp);
        $this->setData('tot_nmp', $tot_nmp);
        $this->setData('nome_dischi', $nome_dischi);
        $this->setData('isCliente', $cli);
        $this->setTemplate("profile_cli.tpl");
    }

    public function load_cl_external($l,$num,$ut,$vot,$numComm,$commenti,$nmp,$tot_nmp,$nome_dischi, $cli){
        $this->setData('cliente', $ut);
        $this->setData('num', $num);
        $this->setData('logged', $l);
        $this->setData('votazioni', $vot);
        $this->setData('numComm', $numComm);
        $this->setData('commenti', $commenti);
        $this->setData('nmp', $nmp);
        $this->setData('tot_nmp', $tot_nmp);
        $this->setData('nome_dischi', $nome_dischi);
        $this->setData('isCliente', $cli);
        $this->setTemplate("profile_seen_cli.tpl");
    }

    public function loadadmin($clienti, $artisti){
        $this->setData('user', $artisti);
        $this->setData('cli', $clienti);
        $this->setTemplate("users.tpl");
    }


    /**
     * @return mixed|string
     */
    public function getSearch(){
        if (isset($_POST['ask']))
            return $_POST['ask'];
        else{
            return "";
        }
    }

    /**
     * @return mixed|string
     */
    public function getPwd(){
        if (isset($_POST['Password']))
            return $_POST['Password'];
        else{
            return "";
        }
    }


    public function getQta(){

        return $_POST['quantitaa'];

    }




}