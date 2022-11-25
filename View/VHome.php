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

    public function ShowIndex($logged){
        //$this->setTemplate('index.tpl');
        $this->setData('logged',$logged);
        $this->setTemplate('homepage.tpl');  //TODO: controllare
    }
}