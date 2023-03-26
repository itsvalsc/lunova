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

    public function load($l,$s, $elenco){
        //$this->setData('user', $l);
        $this->setData('product', $elenco);
        $this->setData('logged', $l);
        $this->setData('artista', $s);
        $this->setTemplate("profile.tpl");
        //$this->setTemplate("user.tpl");
    }

    public function loadadmin($l,$s, $elenco){
        //$this->setData('user', $l);
        $this->setData('product', $elenco);
        $this->setData('logged', $l);
        $this->setData('cli', $s);
        $this->setTemplate("profile.tpl");
        //$this->setTemplate("user.tpl");
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




}