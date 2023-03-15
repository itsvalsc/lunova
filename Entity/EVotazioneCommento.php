<?php

class EVotazioneCommento extends EVoti
{
    private string $utente;
    private string $disco;
    private string $commento;


    public function __construct(string $ut, string $disc, string $commento){
        $this->utente = $ut;
        $this->disco = $disc;
        $this->commento = $commento;
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
    public function getCommento(): string
    {
        return $this->commento;
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
    public function setCommento(string $commento): void
    {
        $this->commento = $commento;
    }
}