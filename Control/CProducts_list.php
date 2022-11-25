<?php
class CProducts_list{

    public static function elenco_dischi(){
        $view = new VProducts_list();
        $pers = FPersistentManager::getInstance();
        FSessione::start();
        $elenco = $pers->prelevaDischi();
        $view->lista_prodotti($elenco);
    }
}
