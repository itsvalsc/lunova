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

    public function cart($l,$product,$disc, $num, $prices)
    {
        $this->setData("logged", $l);
        $this->setData('product', $product);
        $this->setData('disc', $disc);
        $this->setData('num', $num);
        $this->setData('prices', $prices);
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

    public function message($logged,$messaggio,$var_titolo,$var_url){
        $this->setData('message', $messaggio);
        $this->setData('var_titolo', $var_titolo);
        $this->setData('var_url', $var_url);

        $this->setData('logged', $logged);
        $this->setTemplate("message.tpl");
    }
}