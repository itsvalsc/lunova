<?php

/** La classe EVotazioneDisco caratterizza la votazione di un disco attraverso:
 * utente: identifica l'id del cliente che ha effettuato il voto
 * disco: identifica l'id del disco al qiale si riferisce il voto
 * voto: identifica il voto del disco
 */

class EVotazioneDisco{

    private string $utente;
    private string $disco;
    private int $voto;

    public function __construct(string $ut, string $disc, int $voto){
        $this->utente = $ut;
        $this->disco = $disc;
        $this->voto = $voto;
    }

    /** metodi get
     */
    public function getUtente(): string
    { return $this->utente; }

    public function getDisco(): string
    { return $this->disco; }

    public function getVoto(): int
    { return $this->voto; }

    /** metodi set */
    public function setUtente(string $utente): void
    { $this->utente = $utente; }

    public function setDisco(string $disco): void
    { $this->disco = $disco; }

    public function setVoto(int $voto): void
    { $this->voto = $voto; }
}