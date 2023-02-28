<?php

/** La classe ECommento caratterizza il commento di un cd attraverso:
 * Id: identificativo del commento
 * Descrizione: identifica il testo del commento
 * idCliente: identifica l'autore del commento
 * idDisco: identifica il disco su cui viene scritto il commento
 * Voto: identifica il voto dato al disco dal singolo utente
 * Data: identifica il momento in cui è stato scritto il commento
 * Segnalata: indica se il commento è stato segnalato o meno
 */
class ECommento {

    /** attributi */
    private string $id;
    private ECliente $Cliente;
    private string $idDisco;
    private string $descrizione;

    private string $data;
    private bool $segnalata;

    /**
     * Costruttore della classe
     * @param string $idCliente
     * @param string $descrizione
     * @param int $voto
     * @param string $data
     * @param string $disco
     */
    public function __construct(ECliente $Cliente, string $descrizione, string $data, string $idDisco){
        $this->id = "Comm" . random_int(0,9999);
        $this->Cliente = $Cliente;
        $this->descrizione = $descrizione;
        $this->data = $data;
        $this->idDisco=$idDisco;
        $this->segnalata=false;
    }

    /** METODI GET */
    public function getId(): ?string
    { return $this->id; }

    public function getCliente(): ?ECliente
    { return $this->Cliente; }

    public function getDescrizione(): string
    { return $this->descrizione; }



    public function getData(): string
    { return $this->data; }

    public function getIdDisco() : string
    { return $this->idDisco; }

    /** METODI SET */

    public function setId(?string $id): void
    { $this->id = $id; }

    public function setCliente(ECliente $Cliente): void
    { $this->Cliente = $Cliente; }

    public function setDescrizione(string $descrizione): void
    { $this->descrizione = $descrizione; }



    public function setData(string $data): void
    { $this->data = $data; }

    public function setIdDisco(string $idDisco): void
    { $this->idDisco = $idDisco; }

    public function isSegnalato(): bool
    { return $this->segnalata; }

    public function setSegnala(bool $segnalata): void
    { $this->segnalata = $segnalata; }

    /*
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
*/
    /**
     * @return String Stampa le informazioni relative al commento
     */
    /*
    public function __toString() {
        return "TESTO: ".$this->getDescrizione(). " | VALUTAZIONE: ".$this->getVoto()." | SCRITTA DA : ".$this->getUtente(). " | IL: ".$this->getData()." | DATA A: ".$this->getDisco(). "\n";
    }*/

}
?>