<?php
class CCarrello{
    public static function mio_carrello(){
        $view = new VCarrello();
        $pers = FPersistentManager::getInstance();
        $permesso = $view->getButton();
        $utente = 'C151'; //sessione
        $cartid = 'F94';
        if ($permesso){
            $id = $_POST['idprod'];
            $aggiungo = $pers->MinusItem($id,$cartid,$utente);
            unset($_POST["idprod"]);
        }
        unset($_POST["idprod"]);
        $l = true;
        $elenco = $pers->prelevaCartItems('C151');
        $num = count($elenco);
        $Disc = $pers->prelevaCartDischiItems('C151');
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
        $view->cart($l, $elenco,$Disc, $num);
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
        $view->cart($l, $elenco,$Disc, $num);
    }


}