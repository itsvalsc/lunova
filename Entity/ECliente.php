<?php

/**
 * La classe ECliente estende la classe EUtente con degli attributi caratterizzanti attraverso:
 ** IdCliente: id che identifica il cliente in modo univoco
 ** Bannato: identifica lo stato del cliente, ovvero se è stato bannato o meno, viene inizializzato a false
 *  @package Entity
 */

class ECliente extends EUtente{

    private String $IdClient;
    private bool $Bannato;


    public function __construct(){
        if (11 === func_num_args()){
            $username = func_get_arg(0);
            $n = func_get_arg(1);
            $c = func_get_arg(2);
            $v = func_get_arg(3);
            $nc = func_get_arg(4);
            $citta = func_get_arg(5);
            $prov = func_get_arg(6);
            $cap = func_get_arg(7);
            $telefono = func_get_arg(8);
            $email = func_get_arg(9);
            $pw = func_get_arg(10);

            parent::__construct($username,$n, $c, $v, $nc,$citta,$prov,$cap,$telefono,$email,$pw);
            parent::setLivello("C");
            $this->IdClient = "C"  . random_int(0,9999);
            $this->Bannato = false;
        }
        elseif (13 === func_num_args()){
            $email = func_get_arg(0);
            $username = func_get_arg(1);
            $n = func_get_arg(2);
            $c = func_get_arg(3);
            $v = func_get_arg(4);
            $nc = func_get_arg(5);
            $prov = func_get_arg(6);
            $citta = func_get_arg(7);
            $cap = func_get_arg(8);
            $telefono = func_get_arg(9);
            $pw = func_get_arg(10);

            parent::__construct($username,$n, $c, $v, $nc,$citta,$prov,$cap,$telefono,$email,$pw);
            parent::setLivello("C");
            $this->IdClient = func_get_arg(11);
            $this->Bannato = func_get_arg(12);
        }
    }

    /** METODI GET */

    public function getIdClient(): string 
    { return $this->IdClient; }

    public function getBannato(): bool
    { return $this->Bannato; }

    /** METODI SET */

    public function setIdClient(string $id)
    { return $this->IdClient = $id; }

    public function setBannato(bool $ban)
    { return $this->Bannato; }
}

?>