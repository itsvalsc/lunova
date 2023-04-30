<?php

/** La classe EVotazione caratterizza il voto di un sondaggio attraverso:
 * utente: identifica l'utente
 * disco: identifica il disco
 * sondaggio: identifica l'id del sondaggio
*/

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

    /** metodi get */
    public function getUtente(): string
    { return $this->utente; }

    public function getDisco(): string
    { return $this->disco; }

    public function getSondaggio(): string
    { return $this->sondaggio; }

    /** metodi set */
    public function setUtente(string $utente): void
    { $this->utente = $utente; }

    public function setDisco(string $disco): void
    { $this->disco = $disco; }

    public function setSondaggio(string $sondaggio): void
    { $this->sondaggio = $sondaggio; }
}