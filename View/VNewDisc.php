<?php

class VNewDisc
{

    private $smarty;
    private static array $generi= ['Rock'=>'1','Rap'=>'2'];

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

    public function new($logged,$generi)
    {
        $this->setData('logged', $logged);
        $this->setData('gen', $generi);
        $this->setTemplate("addisco.tpl");
    }

    public function message($logged,$messaggio,$var_titolo,$var_url){
        $this->setData('message', $messaggio);
        $this->setData('var_titolo', $var_titolo);
        $this->setData('var_url', $var_url);

        $this->setData('logged', $logged);
        $this->setTemplate("message.tpl");
    }

    /**
     * @return mixed|string
     */
    public function getNome()
    {

            return $_POST['ndisco'];


    }

    /**
     * @return mixed|string
     */
    public function getDescrizione()
    {

            return $_POST['descrizione'];

    }/**
     * @return mixed|string
     */
    public function getGenere()
    {

            $gen = $_POST['genere'];
            return self::$generi[$gen];

    }

    /**
     * @return mixed|string
     */
    public function getPrezzo()
    {

            return $_POST['prezzo'];

    }
    public function getQuantita()
    {

            return $_POST['quantita'];

    }
    public function getImgName()
    {

            return $_FILES['copertina']['name'];

    }
    public function getImgType()
    {

            return $_FILES['copertina']['type'];

    }
    public function getImgData()
    {

            return  @file_get_contents($_FILES['copertina']['tmp_name']);

    }







}