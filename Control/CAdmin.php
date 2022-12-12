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
}