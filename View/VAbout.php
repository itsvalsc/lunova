<?php
class VAbout{
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

    public function about_us($l, $num){
        $this->setData('num', $num);
        $this->setData('logged', $l);
        $this->setTemplate('about.tpl');
    }
}