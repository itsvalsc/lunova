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

    public function ShowIndex($logged,$var,$num,$ut,$cli){
        //$this->setTemplate('index.tpl');
        $this->setData('num',$num);
        $this->setData('logged',$logged);
        $this->setData('var',$var);
        $this->setData('idUtente',$ut);
        $this->setData('isCliente',$cli);

        $this->setTemplate('homepage.tpl');
    }
}