<?php
class VSondaggi{
    /**
     * VLogin constructor.
     */
    public function __construct()
    {
        $this->smarty = StartSmarty::configuration();
    }

    /**
     * @param $name
     * @param $dati
     */
    public function setData($name, $dati)
    {
        $this->smarty->assign($name, $dati);
    }

    /**
     * @param $template
     */
    public function setTemplate($template)
    {
        $this->smarty->display($template);
    }

    public function show($l)
    {
        $this->setData("logged", $l);
        $this->setTemplate('profile.tpl');
    }
}
