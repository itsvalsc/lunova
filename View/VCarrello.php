<?php
class VCarrello
{
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

    public function cart($l,$product,$disc, $num)
    {
        $this->setData("logged", $l);
        $this->setData('product', $product);
        $this->setData('disc', $disc);
        $this->setData('num', $num);
        $this->setTemplate('cart.tpl');
    }

    public function getButton(): bool {
        if (isset ($_POST['idprod'])){
            $bool = true ;
            print_r($_POST['idprod']);
        }
        else {
            $bool = false;
        }
        return $bool;
    }


    public function getFeedback($l){
        $this->setData("logged", $l);
        $this->setTemplate('successorder.tpl');
    }
}