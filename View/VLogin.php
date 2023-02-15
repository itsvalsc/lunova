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

    public function message($logged,$messaggio,$var_titolo,$var_url){
        $this->setData('message', $messaggio);
        $this->setData('var_titolo', $var_titolo);
        $this->setData('var_url', $var_url);

        $this->setData('logged', $logged);
        $this->setTemplate("message.tpl");
    }

    public function ShowIndex($logged,$var){
        //$this->setTemplate('index.tpl');
        $this->setData('logged',$logged);
        $this->setData('var',$var);
        $this->setTemplate('homepage.tpl');
    }



    /**
     * @return mixed|string
     */
    public function getEmail(){
        return $_POST['Email'];
    }

    /**
     * @return mixed|string
     */
    public function getPwd(){

        return $_POST['Password'];

    }

    public function IsArtista():bool{
        if( isset($_POST['type'])){
            $bool=true;
        }else{
            $bool=false;
        }
        return $bool;
    }

    public function Signin($l){
        $this->setData('logged', $l);
        $this->setTemplate("signin.tpl");
    }





}
