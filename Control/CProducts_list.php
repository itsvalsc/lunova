<?php
class CProducts_list{

    public static function elenco_dischi(){
        $view = new VProducts_list();
        $pers = FPersistentManager::getInstance();
        $session = FSessione::getInstance();
        $logged = false;
        if ($session->isLogged()){
            $logged = true;
        }
        $utente = 'C151'; //sessione

        $elencoitems = $pers->prelevaCartItems($utente);
        $num = count($elencoitems);
        $elenco = $pers->prelevaDischi();
        $view->lista_prodotti($elenco,$logged, $num);
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
        $session = FSessione::getInstance();
        $view = new VNewDisc() ;
        if ($session->isLogged() && $session->isArtista()){
            $artista_id = $session->getUtente()->getIdArtista();
            $pers = FPersistentManager::getInstance();
            $nome = $view->getNome();
            $descrizione = $view->getDescrizione();
            $genere = $view->getGenere();
            $prezzo = $view->getPrezzo();
            $quantita = $view->getQuantita();
            $imgName = $view->getImgName();
            $imgType = $view->getImgType();
            $imgData = $view->getImgData();
            $disco = new EDisco($nome,$artista_id,$prezzo,$descrizione,$genere,null,$quantita);
            $image = new EImmagine($imgName,$imgType,$imgData,$disco->getID());
            $disco->setCopertina($image);
            $pers->store($disco);

            $messaggio='Disco Creato Correttamente';
            $view->message(true,$messaggio);
        }else{
            $view->message(false,'accedi come artista per aggiungere un disco');
        }

    }

    public static function recuperaAggiungiProdotto(){
        //$artista = sessione->recupera artista(); da implementare con le sessioni
        $v = new VGestioneProdotto();
        $v->mostraAggiuntaProdotto(/*$artista*/);

    }

    public static function mostra_prodotto(string $id){
        $view = new VProducts_list();
        $pers = FPersistentManager::getInstance();
        $utente = 'C151'; //sessione
        $elenco = $pers->prelevaCartItems($utente);

        $num = count($elenco);
        $prodotto = $pers->load('FDisco',$id);
        $identifier = $pers->FindArtistName($prodotto->getAutore());
        $l = true;
        $view->prodotto_singolo($prodotto,$l, $num, $identifier);

    }


}
