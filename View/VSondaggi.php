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

    public function show(ESondaggio $s,$votazione)
    {
        $totale = $s->getVotiDisco1()+$s->getVotiDisco2()+$s->getVotiDisco3();
        $perc1 = ($s->getVotiDisco1()*100)/$totale;
        $perc2 = ($s->getVotiDisco2()*100)/$totale;
        $perc3 = ($s->getVotiDisco3()*100)/$totale;
        $array = [$perc1,$perc2,$perc3,$totale];


        $this->setData("sondaggio", $s);
        $this->setData("voti", $array);
        $this->setData("votazione", $votazione);

        $this->setTemplate('sondaggi.tpl');
    }
}
