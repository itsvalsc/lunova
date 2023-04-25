<?php
class VSondaggi{
    /**
     * VSondaggi
     */
    public function __construct()
    { $this->smarty = StartSmarty::configuration(); }


    public function setData($name, $dati)
    { $this->smarty->assign($name, $dati); }


    public function setTemplate($template)
    { $this->smarty->display($template); }


    public function show(ESondaggio $s, $votazione, $logged, $num, $cli)
    {
        $totale = $s->getVotiDisco1()+$s->getVotiDisco2()+$s->getVotiDisco3();
        if ($totale==0){
            $perc1=0;
            $perc2=0;
            $perc3=0;
        }else{
            $perc1 = ($s->getVotiDisco1()*100)/$totale;
            $perc2 = ($s->getVotiDisco2()*100)/$totale;
            $perc3 = ($s->getVotiDisco3()*100)/$totale;
        }
        $array = [$perc1,$perc2,$perc3,$totale];


        $this->setData("sondaggio", $s);
        $this->setData("voti", $array);
        $this->setData("votazione", $votazione);
        $this->setData("logged", $logged);
        $this->setData('num',$num);
        $this->setData('isCliente', $cli);

        $this->setTemplate('sondaggi.tpl');
    }
}
