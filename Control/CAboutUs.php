<?php
class CAboutUs{
    public static function us(){
        $view = new VAbout();
        $l = true;
        $pers = FPersistentManager::getInstance();
        $utente = 'C151'; //sessione
        $elenco = $pers->prelevaCartItems($utente);
        $num = count($elenco);
        $view->about_us($l, $num);
    }
}