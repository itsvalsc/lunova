<?php

/** La classe EOrdine caratterizza l'ordine di un cliente attraverso:
 * IdOrdine: identificativo dell'ordine
 * carrello: identifica l'id del carrello
 * IdCliente: identifica l'id del cliente che ha effettuato l'ordine
 * indirizzo: identifica l'indirizzo del cliente a cui viene inviato l'ordine
 * TotOrdine: identifica il prezzo totale
 */

class EOrdine{

    private string $IdOrdine;
    private string $carrello;

    //----------------------------------------------------------

    private string $IdCliente;
    private string $CittaSped;
    private string $CAPSped;
    private string $IndirizzoSped;
    private string $civico;
    private float $TotOrdine;

    public function __construct( ?ECliente $cl)
    {
        $this->IdOrdine = "O".random_int(0, 99999);
        $this->TotOrdine = 0.0;
        $this->IdCliente = $cl->getIdClient();
        $this->carrello = "";
        $this->IndirizzoSped = $cl->getVia();
        $this->civico = $cl->getNumeroCivico();
        $this->CAPSped = $cl->getCAP();
        $this->CittaSped = $cl->getCitta();
    }

    /** metodi get **/

    public function getCittaSpe(): string
    { return $this->CittaSped; }

    public function getIdOrdine(): string
    { return $this->IdOrdine; }

    public function getCapSped(): string
    { return $this->CAPSped; }

    public function getIndirizzoSped(): string
    { return $this->IndirizzoSped; }

    public function getcivico(): string
    { return $this->civico; }

    public function getCarrello(): string
    { return $this->carrello; }

    public function getTotOrdine(): float
    { return $this->TotOrdine; }

    public function getIdCliente(): string
    { return $this->IdCliente; }

    /** metodi set */

    public function setCittaSpe(string $cittaspe): void
    { $this->CittaSped = $cittaspe; }

    public function setIdOrdine($IdOrdine): void
    { $this->IdOrdine = $IdOrdine; }

    public function setCapSped(string $cap): void
    { $this->CAPSped = $cap; }

    public function setIndirizzoSped(string $ind): void
    { $this->IndirizzoSped = $ind; }

    public function setCivico(string $mod): void
    { $this->civico = $mod; }

    public function setTotOrdine(float $tot): void
    { $this->TotOrdine = $tot; }

    public function setIdCliente(string $IdCli): void
    { $this->IdCliente = $IdCli; }

    public function setCarrello(string $car): void
    { $this->carrello = $car; }
}
