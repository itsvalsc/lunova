<?php

class VProducts_list{
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

    public function lista_prodotti($prod,$l){
        $this->setData('logged', $l);
        $this->setData('product', $prod);
        $this->setTemplate('products_list.tpl');
    }

    public function prodotto_singolo($product, $l){
        $this->setData('logged', $l);
        $this->setData('product', $product);
        $this->setTemplate('viewproduct.tpl');
    }
}
