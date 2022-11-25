<?php

/**
 * ok
 * Class EWallet
 */

class EWallet{

    private string $IdWallet;

    private ECarta $Carta;

    private float $Conto;

    private string $IdCliente;

    public function __construct(String $IdCliente){

        $this->IdWallet = "W" . random_int(0, 100);
        $this->Conto = 100.00;
        $this->IdCliente = $IdCliente;

    }

    //metodi get

    public function getIdWallet(): string
    { return $this->IdWallet; }

    public function getConto(): float
    { return $this->Conto; }

    public function getIdCliente(): string
    { return $this->IdCliente; }

    //metodi set

    public function setIdWallet( string $Id)
    { $this->IdWallet = $Id; }

    public function setConto( float $m)
    { $this->Conto = $m; }

    public function setIdCliente(string $IdCliente): void
    { $this->IdCliente = $IdCliente; }

    // _METHODS_

    public function recharge(float $m)
    { $this->Conto += $m ; }

    public function scarica(float $m)
    { $this->Conto =- $m ; }
}