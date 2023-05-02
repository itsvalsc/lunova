<?php

/** La classe ECarrello caratterizza il carello di un cd attraverso:
 * Id: identificativo del carrello
 * dischi: identifica i dischi aggiunti al carrello
 * id_utente: identifica l'id del cliente a cui appartiene il carrello
 * id_ordine: identifica l'id dell'ordine a cui è legato il carrello
 * totale: identifica il prezzo totale del carrello(i.e. la somma di tutti i prezzi dei dischi che sono presenti nel carrello)
 */

class ECarrello{

    private string $id;
    private $dischi = array();
    private string $id_utente;
    private string $id_ordine;
    private float $totale;

    public function __construct($ut)
    {
        if (1 === func_num_args()){
            $this->id = "F"  . random_int(0,99999);
            $this->dischi = array();
            $this->totale = 0.0;
            $this->id_utente=$ut;
        }
        elseif (5 === func_num_args()){
            $idcar=func_get_arg(0);
            $id_cliente=func_get_arg(1);
            $id_ordine=func_get_arg(2);
            $lista=func_get_arg(3);
            $tot=func_get_arg(4);
            $this->id=$idcar;
            $this->id_ordine = $id_ordine;
            $this->dischi = $lista;
            $this->totale = $tot;
            $this->id_utente=$id_cliente;
        }
    }

    /** metodi get */

    public function getId(): string
    { return $this->id; }

    public function getDischi(): array
    { return $this->dischi; }

    public function getIdUtente(): string
    { return $this->id_utente; }

    public function getIdOrdine(): string
    { return $this->id_ordine; }

    public function getTotale(): float
    { return $this->totale; }


    /** metodi set */
    public function setId(string $id): void
    { $this->id = $id; }

    public function setDischi(array $d): void
    { $this->dischi = $d; }

    public function setIdUtente(string $id_utente): void
    { $this->id_utente = $id_utente; }

    public function setIdOrdine(string $id_ordine): void
    { $this->id_ordine = $id_ordine; }

    public function setTotale(float $totale): void
    { $this->totale = $totale; }

    /** Altri metodi */

    public function getToStringDischi(): string{
        $a = "";
        $out = implode(";",array_map(function($a) {return implode("",$a);},$this->getDischi()));
        $out =$out .";";
        return $out;
    }

    /** metodo che permette di aggiungere un disco con la quantità al carrello se disponibile */
    public function aggiungiDisco(EDisco $disco, int $QuantitaRichiesta): void{
        if($disco->getQuantita() >= $QuantitaRichiesta){
            $this->dischi[$disco->getId()] = $QuantitaRichiesta;
            $this->totale += $disco->getPrezzo() * $QuantitaRichiesta;
        }
        else print("Quantità non disponibile");
    }

    /** metodo che permette di modificare la quantità di un disco nel carrello */
    public function modificaQuantita(EDisco $disco, int $quantita): void{
        if ($disco->getQuantita() >= $quantita) {
            $differenzaPrezzo = ($this->dischi[$disco->getId()] - $quantita) * $disco->getPrezzo();
            $this->dischi[$disco->getId()] = $quantita;
            $this->totale += $differenzaPrezzo;
        }
    }
}