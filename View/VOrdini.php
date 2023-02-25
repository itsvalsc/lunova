<?php
class VOrdini{
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

    public function lista_ordini($prod,$l, $num){
        $this->setData('logged', $l);
        $this->setData('ordine', $prod);
        $this->setData('num', $num);
        $this->setTemplate('ordini.tpl');
    }


}