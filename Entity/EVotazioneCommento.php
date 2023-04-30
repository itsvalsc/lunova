<?php

/** La classe EVotazioneCommento caratterizza la votazione di un commento relativo al disco attraverso:
 * utente: identifica l'd dell'utente
 * disco: identifica l'id del disco
 * commento: identifica l'id del commento
 */
class EVotazioneCommento
{
    private string $utente;
    private string $disco;
    private string $commento;


    public function __construct(string $ut, string $disc, string $commento){
        $this->utente = $ut;
        $this->disco = $disc;
        $this->commento = $commento;
    }

    /** metodi get */
    public function getUtente(): string
    { return $this->utente; }

    public function getDisco(): string
    { return $this->disco; }

    public function getCommento(): string
    { return $this->commento; }

    /** metodi set */
    public function setUtente(string $utente): void
    { $this->utente = $utente; }

    public function setDisco(string $disco): void
    { $this->disco = $disco; }

    public function setCommento(string $commento): void
    { $this->commento = $commento; }
}