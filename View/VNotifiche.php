<?php
class VNotifiche{
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

    public function show($alte, $basse, $sond){
        $this->setData('notifica', $alte);
        $this->setData('notificb', $basse);
        $this->setData('notifics', $sond);
        $this->setTemplate('notifiche.tpl');
    }
}