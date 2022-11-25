<?php
/**
 * ok
 * Class ECliente
 * @package Entity
 */
require "EUtente.php";
class EClient extends EUtente{

    private String $IdClient;

    private $Wallet = null;
    /**
    public function __construct(string $n, string $c, string $v, string $nc, string $citta, string $prov, string $cap, string $telefono, string $email, string $pw, $wallet){

        parent::__construct($n, $c, $v, $nc,$citta,$prov,$cap,$telefono,$email,$pw);
        parent::setLivello("C");
        $this->IdClient = "C"  . random_int(0,100);
        $this->Wallet = $wallet;
    }
    */
    public function __construct(){
        if (10 === func_num_args()){
            $n = func_get_arg(0);
            $c = func_get_arg(1);
            $v = func_get_arg(2);
            $nc = func_get_arg(3);
            $citta = func_get_arg(4);
            $prov = func_get_arg(5);
            $cap = func_get_arg(6);
            $telefono = func_get_arg(7);
            $email = func_get_arg(8);
            $pw = func_get_arg(9);
            ;

            parent::__construct($n, $c, $v, $nc,$citta,$prov,$cap,$telefono,$email,$pw);
            parent::setLivello("C");
            $this->IdClient = "C"  . random_int(0,9999);
        }
        elseif (12 === func_num_args()){
            $n = func_get_arg(0);
            $c = func_get_arg(1);
            $v = func_get_arg(2);
            $nc = func_get_arg(3);
            $citta = func_get_arg(4);
            $prov = func_get_arg(5);
            $cap = func_get_arg(6);
            $telefono = func_get_arg(7);
            $email = func_get_arg(8);
            $pw = func_get_arg(9);
            $this->Wallet = func_get_arg(10);
            $this->IdClient = func_get_arg(11);
            parent::__construct($n, $c, $v, $nc,$citta,$prov,$cap,$telefono,$email,$pw);
            parent::setLivello("C");



        }
    }

    //metodi get

    public function getIdClient(): string 
    { return $this->IdClient; }

    public function getWallet()
    { return $this->Wallet; }



    //metodi set

    public function setIdClient(string $id)
    { return $this->IdClient = $id; }
    
}


?>