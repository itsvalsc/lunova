<?php
/**
 * La classe EAddmin estende la classe EUtente con degli attributi caratterizzanti attraverso:
 ** IdAdmin: id che identifica l'amministratore in modo univoco
 *  senza gli attributi relativi all'indirizzo
 *  @package Entity
 */

class EAdmin extends EUtente{

	private string $IdAdmin;

    public function __construct(){
        if (5 === func_num_args()){
            $nome = func_get_arg(0);
            $cognome = func_get_arg(1);
            $email = func_get_arg(2);
            $pw = func_get_arg(3);
            $telefono = func_get_arg(4);
            parent::__construct($nome, $cognome,$email, $pw,$telefono,'A');
            $this->IdAdmin = "A"  . random_int(0,999);
        }
        elseif (6 === func_num_args()){
            $n = func_get_arg(0);
            $c = func_get_arg(1);
            $email = func_get_arg(2);
            $pw = func_get_arg(3);
            $telefono = func_get_arg(4);
            $id_admin = func_get_arg(5);
            parent::__construct($n, $c,$email,$pw,$telefono,'A');
            $this->IdAdmin = $id_admin;
            $this->setUsername('sono un admin');
        }
    }

    public function getIdAmministratore(): string
    { return $this->IdAdmin; }

	public function setIdAmministratore(string $IdAmministratore): void
    { $this->IdAdmin = $IdAmministratore; }
}
?>