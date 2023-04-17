<?php
class VHome{
    private $smarty;
    public function __construct(){

        $this->smarty = StartSmarty::configuration();

    }
    /**
     * @param $template
     */
    public function setTemplate($template){
        $this->smarty->display($template);
    }

    /**
     * @param $name
     * @param $dati
     */
    public function setData($name,$dati){
        $this->smarty->assign($name,$dati);
    }

    public function ShowIndex($logged,$var,$num,$ut){
        //$this->setTemplate('index.tpl');
        $this->setData('num',$num);
        $this->setData('logged',$logged);
        $this->setData('var',$var);
        $this->setData('idUtente',$ut);
        $this->setTemplate('homepage.tpl');  //TODO: controllare
    }

    public function message($logged,$messaggio,$var_titolo,$var_url){
        $this->setData('message', $messaggio);
        $this->setData('var_titolo', $var_titolo);
        $this->setData('var_url', $var_url);
        $this->setData('logged', $logged);
        $this->setTemplate("message.tpl");
    }
}