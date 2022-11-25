<?php

/**
 * Class ECarrello
 */

class ECarrello
{
    private $dischi = array();

    private string $id_utente;
    
    private string $id;

    private string $id_ordine;

    private float $totale;

    //TODO: fare un array associativo con dischi e quantità + metodi per modifica quantità (FATTO ?)
    /**
     * @param string $id
     * @param array $dischi
     *
     */
    public function __construct($ut)
    {
        if (1 === func_num_args()){
            $this->id = "F"  . random_int(0,100);
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

    /**
     * @param string $mail_utente
     */
    public function setIdUtente(string $id_utente): void
    {
        $this->id_utente = $id_utente;
    }

    /**
     * @return string
     */
    public function getIdUtente(): string
    {
        return $this->id_utente;
    }

    /**
     * @param string $id
     */
    public function setId(string $id): void
    {
        $this->id = $id;
    }

    /**
     * @param float $totale
     */
    public function setTotale(float $totale): void
    {
        $this->totale = $totale;
    }

    /**
     * @return float
     */
    public function getTotale(): float
    {
        return $this->totale;
    }
    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getIdOrdine(): string
    {
        return $this->id_ordine;
    }

    /**
     * @return array
     */
    public function getDischi(): array
    {
        return $this->dischi;
    }

    public function setDischi(array $d): void
    {
        $this->dischi = $d;
    }

    /**
     * @return string
     */
    public function getToStringDischi(): string
    {
        $a = "";
        $out = implode(";",array_map(function($a) {return implode("",$a);},$this->getDischi()));
        $out =$out .";";
        //}
        return $out;
    }

    /**
     * @param array $dischi
     */
    public function aggiungiDisco(EDisco $disco, int $QuantitaRichiesta): void
    {
        if($disco->getQuantita() >= $QuantitaRichiesta){
            $this->dischi[$disco->getId()] = $QuantitaRichiesta;
            $this->totale += $disco->getPrezzo() * $QuantitaRichiesta;
        }
        else print("Quantità non disponibile");

    }

    public function modificaQuantita(EDisco $disco, int $quantita): void
    {
        if ($disco->getQuantita() >= $quantita) {
            $differenzaPrezzo = ($this->dischi[$disco->getId()] - $quantita) * $disco->getPrezzo();
            $this->dischi[$disco->getId()] = $quantita;
            $this->totale += $differenzaPrezzo;
        }
    }
}