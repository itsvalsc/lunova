<?php

require_once "Entity/EUtente.php";

class ECliente extends EUtente{

    private String $IdClient;
    private array $dischipreferiti;
    private $Wallet;
    private bool $Bannato;
    /**
    public function __construct(string $n, string $c, string $v, string $nc, string $citta, string $prov, string $cap, string $telefono, string $email, string $pw, $wallet){

        parent::__construct($n, $c, $v, $nc,$citta,$prov,$cap,$telefono,$email,$pw);
        parent::setLivello("C");
        $this->IdClient = "C"  . random_int(0,100);
        $this->Wallet = $wallet;
    }
    */
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
            $this->Wallet = func_get_arg(11);
            $this->IdClient = func_get_arg(12);
            $this->Bannato = false;
        }
    }

    /** METODI GET */

    public function getIdClient(): string 
    { return $this->IdClient; }

    public function getWallet()
    { return $this->Wallet; }

    public function getDischiPref(): array
    { return $this->dischipreferiti; }

    public function getBannato(): bool
    { return $this->Bannato; }

    /** METODI SET */

    public function setIdClient(string $id)
    { return $this->IdClient = $id; }

    public function setBannato(bool $ban)
    { return $this->Bannato; }

    /** ALTRI METODI */

    public function addDisco($disco): void
    { $this->dischipreferiti.array_push($disco); }

    public function deleteDisco($disco): void {
        for($i = 0; $i<count($this->dischipreferiti); $i++){
            if($this->dischipreferiti[$i] == $disco){
                unset($this->dischipreferiti[$i]);
            }
        }
    }

    /**
     * Metodo che cripta la password inserita da un utente con un hash
     * da 60 caratteri
     * @param string $password
     * @return string
     */
    public static function criptaPassword(string $password): string {
        return hash('sha256',$password);
    }

    /**
     * Metodo che verifica la password inserita corrisponda all'hash
     * nel database
     * @param string $password
     * @return string
     */
    public static function verificaPassword(string $password, string $hash): bool {
        return password_verify($password, $hash);
    }
}

?>