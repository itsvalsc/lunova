<?php
/**
 * ok
 * @package Entity
 */
class ENotifiche
{
    private string $id;
    private string $testo;
    private string $priorita;
    private string $mittente;

    public function __construct(string $t, string $pri, string $mit)
    {
        $this->id = "N" . random_int(0, 1000);
        $this->testo = $t;
        $this->priorita = $pri;
        $this->mittente = $mit;

    }

    //metodi get
    public function getId()
    { return($this->id); }

    public function getText()
    { return($this->testo); }

    public function getPriority()
    { return($this->priorita); }

    public function getMittente()
    { return($this->mittente); }

    //metodi set
    public function setId( string $idc ) : void
    {
        $this->id = $idc;
    }

    public function setPriority(string $p): void
    {
        $this->priorita = $p;
    }

    public function setText(string $t): void
    {
        $this->testo = $t;
    }

    public function setMittente(string $m): void
    {
        $this->mittente = $m;
    }

}
