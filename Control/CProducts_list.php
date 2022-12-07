<?php
class CProducts_list{

    public static function elenco_dischi(){
        $view = new VProducts_list();
        $pers = FPersistentManager::getInstance();
        FSessione::start();
        $elenco = $pers->prelevaDischi();
        $view->lista_prodotti($elenco);
    }

    public static function salva_foto(){
        $view = new VAbout();
        $id = $_POST['idAppartenenza'];
        $nome = $_FILES['file1']['name'];
        $type = $_FILES['file1']['type'];
        $immagine = @file_get_contents($_FILES['file1']['tmp_name']);
        $image = new EImmagine($nome,$type,$immagine,$id);
        $pers = FPersistentManager::getInstance();
        $prova = 'immagine caricata';
        $view->about_us($prova);
    }


}
