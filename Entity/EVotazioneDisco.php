<?php

class EVotazioneDisco
{
    private string $utente;
    private string $disco;
    private int $voto;


    public function __construct(string $ut, string $disc, int $voto){
        $this->utente = $ut;
        $this->disco = $disc;
        $this->voto = $voto;
    }

    /**
     * @return string
     */
    public function getUtente(): string
    {
        return $this->utente;
    }

    /**
     * @return string
     */
    public function getDisco(): string
    {
        return $this->disco;
    }

    /**
     * @return int
     */
    public function getVoto(): int
    {
        return $this->voto;
    }

    /**
     * @param string $utente
     */
    public function setUtente(string $utente): void
    {
        $this->utente = $utente;
    }

    /**
     * @param string $disco
     */
    public function setDisco(string $disco): void
    {
        $this->disco = $disco;
    }

    /**
     * @param int $sondaggio
     */
    public function setVoto(int $voto): void
    {
        $this->voto = $voto;
    }


}