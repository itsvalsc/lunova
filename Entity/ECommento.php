<?php

/** La classe ECommento caratterizza il commento di un cd attraverso:
 * Id: identificativo del commento
 * Descrizione: identifica il testo del commento
 * Utente: identifica l'autore del commento
 * Disco: identifica il disco su cui viene scritto il commento
 * Voto: identifica il voto dato al disco dal singolo utente
 * Data: identifica il momento in cui è stato scritto il commento
 * Segnalata: indica se il commento è stato segnalato o meno
 */
class ECommento implements JsonSerializable {

    /** attributi */
    private string $id;
    private EUtente $utente;
    private EDisco $disco;
    private string $descrizione;
    private float $voto;
    private string $data;
    private bool $segnalata;

    /**
     * Costruttore della classe
     * @param EUtente $utente
     * @param string $descrizione
     * @param float $voto
     * @param string $data
     * @param EDisco $disco
     */
    public function __construct(EUtente $utente, string $descrizione, float $voto, string $data,EDisco $disco){
        $this->id = "Comm" . random_int(0,9999);
        $this->utente = $utente;
        $this->descrizione = $descrizione;
        $this->voto = $voto;
        $this->data = $data;
        $this->disco=$disco;
        $this->segnalata=false;
    }

    /** METODI GET */
    public function getId(): ?int
    { return $this->id; }

    public function getUtente(): EUtente
    { return $this->utente; }

    public function getDescrizione(): string
    { return $this->descrizione; }

    public function getVoto(): float
    { return $this->voto; }

    public function getData(): string
    { return $this->data; }

    public function getDisco() : EDisco
    { return $this->disco; }

    /** METODI SET */

    public function setId(?int $id): void
    { $this->id = $id; }

    public function setUtente(EUtente $utente): void
    { $this->utente = $utente; }

    public function setDescrizione(string $descrizione): void
    { $this->descrizione = $descrizione; }

    public function setVoto(float $voto): void
    { $this->voto = $voto; }

    public function setData(string $data): void
    { $this->data = $data; }

    public function setDisco(EDisco $disco): void
    { $this->disco = $disco; }

    public function isSegnalato(): bool
    { return $this->segnalata; }

    public function setSegnala(bool $segnalata): void
    { $this->segnalata = $segnalata; }

    public function jsonSerialize()
    {
        return
            [
                'id'   => $this->getId(),
                'utente' => $this->getUtente(),
                'disco'   => $this->getDisco(),
                'descrizione'   => $this->getDescrizione(),
                'voto'   => $this->getVoto(),
                'data'   => $this->getData(),
                'segnalato'   => $this->isSegnalato()
            ];
    }

    /**
     * @return String Stampa le informazioni relative al commento
     */
    public function __toString() {
        return "TESTO: ".$this->getDescrizione(). " | VALUTAZIONE: ".$this->getVoto()." | SCRITTA DA : ".$this->getUtente(). " | IL: ".$this->getData()." | DATA A: ".$this->getDisco(). "\n";
    }

}
?>