<?php
class CAdmin{
    public static function users(){
        $view = new VUsers();
        $pers = FPersistentManager::getInstance();
        FSessione::start();
        $Cli = $pers->prelevaClienti();
        $Art = $pers->prelevaArtisti();
        $view->load($Art,$Cli);
    }

    public static function notifiche(){
        $view = new VNotifiche();
        $pers = FPersistentManager::getInstance();
        FSessione::start();
        $alte = $pers->prelNotifAlte();
        $basse = $pers->prelNotifBasse();
        $sond = $pers->prelNotifSond();
        $view->show($alte,$basse, $sond);
    }
}