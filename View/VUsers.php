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

    public function load($l,$s){
        $this->setData('user', $l);
        $this->setData('cli', $s);
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




}