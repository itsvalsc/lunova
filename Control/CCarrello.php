<?php
class CCarrello{
    public static function mio_carrello(){
        $view = new VCarrello();
        $pers = FPersistentManager::getInstance();
        $utente = 'C151'; //sessione
        $cartid = 'F94';
        $l = true;
        $elenco = $pers->prelevaCartItems($utente);
        $num = count($elenco);
        $Disc = $pers->prelevaCartDischiItems($utente);
        $view->cart($l, $elenco,$Disc, $num);
    }

    public static function Add(string $id){
        $view = new VCarrello();
        $l = true;
        $utente = 'C151'; //sessione
        $cartid = 'F94';

        $pers = FPersistentManager::getInstance();
        $aggiungo = $pers->AddItem($id,$cartid,$utente);

        $elenco = $pers->prelevaCartItems($utente);
        $num = count($elenco);
        $Disc = $pers->prelevaCartDischiItems($utente);
        header ("Location: /lunova/Carrello/mio_carrello");
        //$view->cart($l, $elenco,$Disc, $num);
    }

    public static function Minus(string $id){
        $view = new VCarrello();
        $l = true;
        $utente = 'C151'; //sessione
        $cartid = 'F94';

        $pers = FPersistentManager::getInstance();
        $aggiungo = $pers->MinusItem($id,$cartid,$utente);

        $elenco = $pers->prelevaCartItems($utente);
        $num = count($elenco);
        $Disc = $pers->prelevaCartDischiItems($utente);
        header ("Location: /lunova/Carrello/mio_carrello");
        //$view->cart($l, $elenco,$Disc, $num);
    }


}