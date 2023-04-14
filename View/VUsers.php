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

    public function load($l,$s, $elenco, $num, $controllo,$numComm){
        //$this->setData('user', $l);
        $this->setData('product', $elenco);
        $this->setData('logged', $l);
        $this->setData('artista', $s);
        $this->setData('numero', $num);
        $this->setData('numComm', $numComm);
        $this->setData('controllo', $controllo);
        $this->setTemplate("profile.tpl");
        //$this->setTemplate("user.tpl");
    }

    public function loadadmin($l,$clienti, $artisti){
        $this->setData('user', $artisti);
        $this->setData('logged', $l);
        $this->setData('cli', $clienti);
        //$this->setTemplate("profile.tpl");
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