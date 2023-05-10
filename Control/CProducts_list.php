<?php

/**
 * La classe CProducts_list implementa funzionalità per la visualizzazione e la gestione dei dischi sulla piattaforma. è possibile:
 * Visualizzare la lista dei prodotti e del prodotto singolo;
 * Aggiungere ed eliminare dischi ( da parte di un artista loggato )
 * @package Controller
 */
class CProducts_list{

    /**
     * Mostra la schermata relativa all'elenco dei dischi
     * @return null
     */
    public static function elenco_dischi(){
        $view = new VProducts_list();
        $pers = FPersistentManager::getInstance();
        $session = FSessione::getInstance();
        $logged = false;
        $num = null;
        $cli = false;

        if ($session->isLogged()){
            if ($session->isCliente()){
                $cli = true;
                $elenco = $pers->prelevaCartItems($session->getUtente()->getIdClient());
                $num = count($elenco);
            }
        }

        $elenco = $pers->prelevaDischi();
        $generi = $pers->prelevaGeneri();
        return $view->lista_prodotti($elenco,$session->isLogged(), $num,$generi,$cli);
    }

    /**
     * Permette ad un artista di creare e inserire nel sito un nuovo disco
     * @return null
     */
    public static function aggiungi_disco(){
        $session = FSessione::getInstance();
        $view = new VNewDisc() ;
        $mess = new VErrore();

        if ($session->isLogged() && $session->isArtista()){
            $artista_id = $session->getUtente()->getIdArtista();
            $pers = FPersistentManager::getInstance();
            $bannato = ($pers->load('FArtista',$session->getUtente()->getEmail()))->getBannato();
            if ($bannato ==1){
                return $mess->message(true,'Impossibile creare un nuovo disco, il tuo profilo è stato temporaneamente sospeso','alla home','',null,false);
            }
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
            return $mess->message(true,$messaggio,'alla home','',null,false);
        }else{
            return $mess->message(false,'accedi come artista per aggiungere un disco','','',null,false);
        }
    }


    /**
     * Permette all'artista di eliminare un disco precedentemente creato
     * @param $id
     * @return null
     */
    public static function delete_disco($id){
        $session = FSessione::getInstance();
        $mess = new VErrore();
        if ($session->isLogged() && $session->isArtista()){
            $artista_id = $session->getUtente()->getIdArtista();
            $pers = FPersistentManager::getInstance();
            $dc = $pers->load('FDisco',$id);
            if ($dc ==null || $dc->getAutore()!=$artista_id){
                return header('Location: /lunova/Errore/unathorized');
            }
            $pers->delete('FDisco',$id);
            $messaggio='Disco Eliminato Correttamente';
            return $mess->message(true,$messaggio,'alla home','',null,false);
        }else{
            return header('Location: /lunova');
        }
    }


    /**
     * Metodo che mostra la schermata del prodotto singolo
     * @param string $id
     * @return null
     */
    public static function mostra_prodotto(string $id){
        $view = new VProducts_list();
        $err = new VErrore();
        $pers = FPersistentManager::getInstance();
        $session = FSessione::getInstance();
        $num = null;
        $cli = false;
        $votazione=false;
        $mpComm = []; //gli passo l array dei commenti relativi ad un disco a cui ha messo mi piace
        if ($session->isLogged()){
            if ($session->isCliente()){
                $utente = $session->getUtente()->getIdClient();
                $cli = true;
                $elenco = $pers->prelevaCartItems($utente);
                $num = count($elenco);
                $votazione = $pers->exist('FVotazioneDisco',$utente,$id);
                $mpComm = $pers->loadmpCommenti($utente,$id);
            }
        }
        $prodotto = $pers->load('FDisco',$id);
        if ($prodotto != null){
            $commenti = $pers->loadCommenti($id);
            $art = $pers->FindArtistName($prodotto->getAutore());
            $nmp = $pers->loadNumeroMP($id);
            $mediaVoti = $pers->media($pers->load('FVotazioneDisco',$id));
            $starRate= $pers->star_Rate($mediaVoti);
            $starRating = [$starRate,$mediaVoti,$votazione];
            return $view->prodotto_singolo($prodotto,$session->isLogged(), $num,$art,$commenti,$utente??null,$starRating,$mpComm,$nmp,$cli);
        }else{
            return $err->message($session->isLogged(),"Non è stato possibile trovare il disco selezionato",'alla ricerca dischi','Products_list/elenco_dischi',$num,$cli);
        }
    }






}
