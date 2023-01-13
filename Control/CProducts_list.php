<?php
class CProducts_list{

    public static function elenco_dischi(){
        $view = new VProducts_list();
        $pers = FPersistentManager::getInstance();
        FSessione::start();
        $elenco = $pers->prelevaDischi();
        $view->lista_prodotti($elenco);
    }
    /*
    public static function salva_foto(){
        $view = new VAbout();
        $id = $_POST['idAppartenenza'];
        $nome = $_FILES['file1']['name'];
        $type = $_FILES['file1']['type'];
        $immagine = @file_get_contents($_FILES['file1']['tmp_name']);
        $image = new EImmagine($nome,$type,$immagine,$id);
        $pers = FPersistentManager::getInstance();
        $a = $pers->store($image);
        $prova = 'immagine caricata';

        $view->about_us($prova);
    }
    */
    public static function aggiungi_disco(){
        $view = new VNewDisc() ;
        $viewmex = new VAbout();
        $pers = FPersistentManager::getInstance();
        $nome = $view->getNome();
        $descrizione = $view->getDescrizione();
        $genere = $view->getGenere();
        $prezzo = $view->getPrezzo();
        $quantita = $view->getQuantita();
        $imgName = $view->getImgName();
        $imgType = $view->getImgType();
        $imgData = $view->getImgData();
        $autore = 'A1'; //aggiungere l'artista tramite le sessioni

        $disco = new EDisco($nome,$autore,$prezzo,$descrizione,$genere,null,$quantita);
        $image = new EImmagine($imgName,$imgType,$imgData,$disco->getID());
        $disco->setCopertina($image);

        $pers->store($disco);



        $messaggio='tutt appost fra';
        $viewmex->about_us($messaggio);
    }

    public static function recuperaAggiungiProdotto(){
        //$artista = sessione->recupera artista(); da implementare con le sessioni
        $v = new VGestioneProdotto();
        $v->mostraAggiuntaProdotto(/*$artista*/);

    }

    public static function mostra_prodotto(string $id){
        $view = new VProducts_list();
        $pers = FPersistentManager::getInstance();
        $prodotto = $pers->load('FDisco',$id);
        $view->prodotto_singolo($prodotto);

    }


}
