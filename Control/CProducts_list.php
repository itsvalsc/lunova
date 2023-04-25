<?php
class CProducts_list{

    public static function elenco_dischi(){
        $view = new VProducts_list();
        $pers = FPersistentManager::getInstance();
        $session = FSessione::getInstance();
        $logged = false;
        $num = null;

        if ($session->isLogged()){
            if ($session->isCliente()){
                $utente = $session->getUtente()->getIdClient();
                //todo:scommentare per il settaggio del carrello
                //$cartid = $session->getCarrello()->getId();
                //$elencoitems = $pers->prelevaCartItems($utente);
                //$num = count($elencoitems);
            }
        }

        $elenco = $pers->prelevaDischi();
        $generi = $pers->prelevaGeneri();
        return $view->lista_prodotti($elenco,$session->isLogged(), $num,$generi);
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
            return $view->message(true,$messaggio,'alla home','');
        }else{
            return $view->message(false,'accedi come artista per aggiungere un disco');
        }

    }

    public static function recuperaAggiungiProdotto(){
        //$artista = sessione->recupera artista(); da implementare con le sessioni
        $v = new VGestioneProdotto();
        $v->mostraAggiuntaProdotto(/*$artista*/);

    }

    public static function mostra_prodotto(string $id){
        $view = new VProducts_list();
        $err = new VErrore();
        $pers = FPersistentManager::getInstance();
        $session = FSessione::getInstance();
        $num = null;
        $votazione=false;
        $mpComm = []; //gli passo l array dei commenti relativi ad un disco a cui ha messo mi piace

        if ($session->isLogged()){
            if ($session->isCliente()){
                $utente = $session->getUtente()->getIdClient();
                //todo: scommentare per carrello
                //$cartid = $session->getCarrello()->getId();
                //$elencoitems = $pers->prelevaCartItems($utente);
                //$num = count($elencoitems);
                $votazione = $pers->exist('FVotazioneDisco',$utente,$id);
                $mpComm = $pers->loadmpCommenti($utente,$id);
            }
        }
        $prodotto = $pers->load('FDisco',$id);
        if ($prodotto != null){
            $commenti = $pers->loadCommenti($id);
            $art = $pers->FindArtistName($prodotto->getAutore());
            $nmp = $pers->loadNumeroMP($id);
            $mediaVoti = self::media($pers->load('FVotazioneDisco',$id));
            $starRate= self::star_Rate($mediaVoti);
            $starRating = [$starRate,$mediaVoti,$votazione];
            return $view->prodotto_singolo($prodotto,$session->isLogged(), $num,$art,$commenti,$utente??null,$starRating,$mpComm,$nmp);
        }else{
            return $err->message($session->isLogged(),"Non è stato possibile trovare il disco selezionato",'alla ricerca dischi','Products_list/elenco_dischi');
        }
    }

    public static function star_Rate($media){
        if ($media <= 0.75){//0.5
            $starRate = ['fa fa-star-half-o','fa fa-star-o','fa fa-star-o','fa fa-star-o','fa fa-star-o'];
        } elseif ($media > 0.75 & $media <= 1.25){//1
            $starRate = ['fa fa-star','fa fa-star-o','fa fa-star-o','fa fa-star-o','fa fa-star-o'];
        }elseif ($media > 1.25 & $media <= 1.75 ) {//1.5
            $starRate = ['fa fa-star','fa fa-star-half-o','fa fa-star-o','fa fa-star-o','fa fa-star-o'];
        }elseif ($media > 1.75 & $media < 2.25){//2
            $starRate = ['fa fa-star','fa fa-star','fa fa-star-o','fa fa-star-o','fa fa-star-o'];
        }elseif ($media > 2.25 & $media <= 2.75){//2.5
            $starRate = ['fa fa-star','fa fa-star','fa fa-star-half-o','fa fa-star-o','fa fa-star-o'];
        }elseif ($media > 2.75 & $media <= 3.25){//3
            $starRate = ['fa fa-star','fa fa-star','fa fa-star','fa fa-star-o','fa fa-star-o'];
        }elseif ($media > 3.25 & $media <= 3.75){//3.5
            $starRate = ['fa fa-star','fa fa-star','fa fa-star','fa fa-star-half-o','fa fa-star-o'];
        }elseif ($media > 3.75 & $media <= 4.25){//4
            $starRate = ['fa fa-star','fa fa-star','fa fa-star','fa fa-star','fa fa-star-o'];
        }elseif ($media > 4.25 & $media <= 4.75){//4.5
            $starRate = ['fa fa-star','fa fa-star','fa fa-star','fa fa-star','fa fa-star-half-o'];
        }elseif ($media > 4.75 ){//5
            $starRate = ['fa fa-star','fa fa-star','fa fa-star','fa fa-star','fa fa-star'];
        }
        return $starRate;
    }

    private static function media($array){
        $sum = 0;
        if (count($array)==0){
            $result = 0;
        }
        else{
            foreach ($array as $voti){
                $sum += $voti;
            }
            $result = $sum/count($array);
        }

        return $result;
    }


}
