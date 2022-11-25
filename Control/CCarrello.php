<?php
class CCarrello{
    public static function mio_carrello(){
        $view = new VCarrello();
        $l = true;
        $view->cart($l);
    }
}