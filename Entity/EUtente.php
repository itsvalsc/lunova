<?php

/**
 * OK
 * Class EUtente
 */
//cambio da private in protected
class EUtente{

    protected string $Nome;

    protected string $Cognome;

    protected string $Via;

    protected string $NumeroCivico;

    protected string $Citta;

    protected string $Provincia;

    protected string $CAP;

    protected string $Telefono;

    protected string $Livello;

    protected string $Email;

    protected string $Password;

    protected $Profilo;

    /**
     * EUtente constructor.
     * @param string $n
     * @param string $c
     * @param string $v
     * @param string $nc
     * @param string $citta
     * @param string $prov
     * @param string $cap
     * @param string $telefono
     * @param string $email
     * @param string $pw
     */

    public function __construct($ut)
    {
        if (5 === func_num_args()){
            $this->Nome = func_get_arg(0);
            $this->Cognome = func_get_arg(1);
            $this->Email = func_get_arg(2);
            $this->Password = func_get_arg(3);
            $this->Livello = func_get_arg(4);    //scelta multipla per il livello di iscrizione
            $this->Via = "";
            $this->NumeroCivico = "";
            $this->Citta = "";
            $this->Provincia = "";
            $this->CAP = "";
            $this->Telefono = "";
            $this->Profilo = null;
        }
        elseif (10 === func_num_args()){
            $this->Nome = func_get_arg(0);
            $this->Cognome = func_get_arg(1);
            $this->Via = func_get_arg(2);
            $this->NumeroCivico = func_get_arg(3);
            $this->Citta = func_get_arg(4);
            $this->Provincia = func_get_arg(5);
            $this->CAP = func_get_arg(6);
            $this->Telefono = func_get_arg(7);
            $this->Email = func_get_arg(8);
            $this->Password = func_get_arg(9);
                //scelta multipla per il livello di iscrizione
        }
    }
    
    /**
     * @param string $livello
     */

    public function setLivello(string $livello) 
    { $this->Livello = $livello; }

    public function setProfilo(EImmagine $p) 
    { $this->Profilo = $p; }    

    /**
     * @return string
     */
    public function getEmail(): string
    { return $this->Email; }

    /**
     * @return string
     */
    public function getNome(): string
    { return $this->Nome; }

    /**
     * @return string
     */
    public function getCognome(): string
    { return $this->Cognome; }

    /**
     * @return string
     */
    public function getVia(): string
    { return $this->Via; }

    /**
     * @return string
     */
    public function getNumeroCivico(): string
    { return $this->NumeroCivico; }

    /**
     * @return string
     */
    public function getCitta(): string
    { return $this->Citta; }

    public function getProfilo(): EImmagine
    { return $this->Profilo; }

    /**
     * @return string
     */
    public function getProvincia(): string
    { return $this->Provincia; }

    /**
     * @return string
     */
    public function getCAP(): string
    { return $this->CAP; }

    /**
     * @return string
     */
    public function getTelefono(): string
    { return $this->Telefono; }

    /**
     * @return string
     */
    public function getLivello(): string
    { return $this->Livello; }

    /**
     * @return string
     */
    public function getPassword(): string
    { return $this->Password; }

    public function setNome($n): void{
        $this->Nome=$n;
    }
}


