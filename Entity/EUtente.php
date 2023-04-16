<?php

class EUtente{

    protected string $Username;
    protected string $Nome;
    protected string $Cognome;
    protected string $Email;
    protected string $Password;
    protected string $Via;
    protected string $NumeroCivico;
    protected string $Citta;
    protected string $Provincia;
    protected string $CAP;
    protected string $Telefono;
    protected string $Livello;
    protected ?EImmagine $ImmProfilo;

    /**
     * EUtente constructor.
     * @param string $user
     * @param string $n
     * @param string $c
     * @param string $email
     * @param string $pw
     * @param string $v
     * @param string $nc
     * @param string $citta
     * @param string $prov
     * @param string $cap
     * @param string $telefono
     */

    public function __construct($ut)
    {
        if (6 === func_num_args()){
            $this->Username = '';
            $this->Nome = func_get_arg(0);
            $this->Cognome = func_get_arg(1);
            $this->Email = func_get_arg(2);
            $this->Password = func_get_arg(3);
            $this->Telefono = func_get_arg(4);
            $this->Livello = func_get_arg(5);    //scelta multipla per il livello di iscrizione
            $this->Via = "";
            $this->NumeroCivico = "";
            $this->Citta = "";
            $this->Provincia = "";
            $this->CAP = "";

            $this->Profilo = null;
        }
        elseif (11 === func_num_args()){
            $this->Username = func_get_arg(0);
            $this->Nome = func_get_arg(1);
            $this->Cognome = func_get_arg(2);
            $this->Via = func_get_arg(3);
            $this->NumeroCivico = func_get_arg(4);
            $this->Citta = func_get_arg(5);
            $this->Provincia = func_get_arg(6);
            $this->CAP = func_get_arg(7);
            $this->Telefono = func_get_arg(8);
            $this->Email = func_get_arg(9);
            $this->Password = func_get_arg(10);
                //scelta multipla per il livello di iscrizione
        }
    }
    
    /** metodi get */

    public function getUsername(): string
    { return $this->Username; }

    public function getNome(): string
    { return $this->Nome; }

    public function getCognome(): string
    { return $this->Cognome; }

    public function getEmail(): string
    { return $this->Email; }

    public function getPassword(): string
    { return $this->Password; }

    public function getVia(): string
    { return $this->Via; }

    public function getNumeroCivico(): string
    { return $this->NumeroCivico; }

    public function getCitta(): string
    { return $this->Citta; }

    public function getProvincia(): string
    { return $this->Provincia; }

    public function getCAP(): string
    { return $this->CAP; }

    public function getTelefono(): string
    { return $this->Telefono; }

    public function getImmProfilo(): EImmagine
    { return $this->ImmProfilo; }

    public function getLivello(): string
    { return $this->Livello; }


    /** metodi set */

    public function setUsername( string $user): void
    { $this->Username=$user; }

    public function setNome(string $n): void
    { $this->Nome=$n; }

    public function setCognome(string $c): void
    { $this->Cognome=$c; }

    public function setEmail(string $email): void
    { $this->Email=$email; }

    public function setPassword(string $pw): void
    { $this->Password=$pw; }

    public function setVia(string $v): void
    { $this->Via=$v; }

    public function setNCivico(string $nc): void
    { $this->NumeroCivico=$nc; }

    public function setCitta(string $c): void
    { $this->Citta=$c; }

    public function setProvincia(string $prov): void
    { $this->Provincia=$prov; }

    public function setCAP(string $cap)
    { $this->CAP = $cap; }

    public function setTelefono(string $tel)
    { $this->Telefono = $tel; }

    public function setLivello(string $livello)
    { $this->Livello = $livello; }

    public function setImmProfilo(EImmagine $p)
    { $this->ImmProfilo = $p; }

    /** ALTRI METODI*/


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


