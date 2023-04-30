<?php

/** La classe ERichiesta caratterizza la richiesta di un artista di voler partecipare a un sondaggio con un suo disco attraverso:
 * disco: identificativo dell'id del disco con il quale si vuole effettuare la richiesta
 * data: identifica la data della richiesta
 * nome_artista: identifica l'id dell'artista che ha effettuato la richiesta
 */

class ERichiesta{

    private string $disco;
    private string $data;
    private string $nome_artista;

    public function __construct($id_disco,$date,$art){
        $this->disco= $id_disco;
        $this->data= $date;
        $this->nome_artista= $art;
    }


    /** metodi get */

    public function getDisco(): string
    { return $this->disco; }

    public function getData(): string
    { return $this->data; }

    public function getArtista(): string
    { return $this->nome_artista; }


    /** metodi set */
    public function setDisco(string $disco): void
    { $this->disco = $disco; }

    public function setData(string $data): void
    { $this->data = $data; }

    public function setArtista(string $art): void
    { $this->nome_artista = $art; }
}