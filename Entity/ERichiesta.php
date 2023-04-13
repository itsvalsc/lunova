<?php

class ERichiesta
{
private string $disco;
private string $data;
private string $nome_artista;

    public function __construct($id_disco,$date,$art){
        $this->disco= $id_disco;
        $this->data= $date;
        $this->nome_artista= $art;
    }


    /**
     * @return string
     */
    public function getDisco(): string
    {
        return $this->disco;
    }

    /**
     * @return string
     */
    public function getData(): string
    {
        return $this->data;
    }

    /**
     * @return string
     */
    public function getArtista(): string
    {
        return $this->nome_artista;
    }


    /**
     * @param string $disco
     */
    public function setDisco(string $disco): void
    {
        $this->disco = $disco;
    }

    /**
     * @param string $data
     */
    public function setData(string $data): void
    {
        $this->data = $data;
    }

    /**
     * @param string $data
     */
    public function setArtista(string $art): void
    {
        $this->nome_artista = $art;
    }


}