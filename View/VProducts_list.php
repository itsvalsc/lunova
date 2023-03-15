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

    public function lista_prodotti($prod,$l, $num){
        $this->setData('logged', $l);
        $this->setData('product', $prod);
        $this->setData('num', $num);
        $this->setTemplate('products_list.tpl');
    }

    public function prodotto_singolo($product, $l, $num, $artista,$commenti,$utente,$starRating,$a,$nmp){
        $this->setData('logged', $l);
        $this->setData('product', $product);
        $this->setData('num', $num);
        $this->setData('artist',$artista);
        $this->setData('commenti',$commenti);
        $this->setData('proprieta',$utente);
        $this->setData('star',$starRating[0]);
        $this->setData('media',$starRating[1]);
        $this->setData('votazione',$starRating[2]);
        $this->setData('arr',$a);
        $this->setData('nmp',$nmp);

        $this->setTemplate('viewproduct.tpl');
    }
}
