<?php

class EVotazione
{
    private string $utente;
    private string $disco;
    private string $sondaggio;


    public function __construct(string $ut, string $disc, string $sond){
        $this->utente = $ut;
        $this->disco = $disc;
        $this->sondaggio = $sond;
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
     * @return string
     */
    public function getSondaggio(): string
    {
        return $this->sondaggio;
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
     * @param string $sondaggio
     */
    public function setSondaggio(string $sondaggio): void
    {
        $this->sondaggio = $sondaggio;
    }


}