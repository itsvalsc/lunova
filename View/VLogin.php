<?php
class VLogin{

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

    public function Login($l){
        $this->setData('logged', $l);
        $this->setTemplate("login.tpl");
    }


    /**
     * @return mixed|string
     */
    public function getEmail(){
        if (isset($_POST['Email']))
            return $_POST['Email'];
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

    public function Signin($l){
        $this->setData('logged', $l);
        $this->setTemplate("signin.tpl");
    }



}
