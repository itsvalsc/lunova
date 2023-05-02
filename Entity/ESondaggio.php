<?php

/** La classe ESondaggio caratterizza il sondaggio attraverso:
 * id: identificativo del sondaggio
 * disco_n: identifica i 3 dischi che partecipano al sondaggio
 * voti_disco_n: identifica il numero di voti di ciascuno dei 3 dischi
 * data: identifica la data del sondaggio
 * in_corso: identifica se il sondaggio è in corso o è finito
 */

class ESondaggio{

    private string $id;
    private EDisco $disco_1;
    private int $voti_disco_1;
    private EDisco $disco_2;
    private int $voti_disco_2;
    private EDisco $disco_3;
    private int $voti_disco_3;
    private string $data;
    private bool $in_corso;

    public function __construct(EDisco $disco1,EDisco $disco2,EDisco $disco3,string $date){
        $this->id = "S"  . random_int(0,99999);
        $this->disco_1 = $disco1;
        $this->disco_2 = $disco2;
        $this->disco_3 = $disco3;
        $this->data = $date;
        $this->in_corso = 0;
    }

    /** metodi get */

    public function getId(): string
    { return $this->id; }

    public function getDisco1(): EDisco
    { return $this->disco_1; }

    public function getDisco2(): EDisco
    { return $this->disco_2; }

    public function getDisco3(): EDisco
    { return $this->disco_3; }

    public function getVotiDisco1(): int
    { return $this->voti_disco_1; }

    public function getVotiDisco2(): int
    { return $this->voti_disco_2; }

    public function getVotiDisco3(): int
    { return $this->voti_disco_3; }

    public function getInCorso(): bool
    { return $this->in_corso; }

    public function getData(): string
    { return $this->data; }

    /** metodi set */

    public function setId(string $id): void
    { $this->id = $id; }

    public function setDisco1(EDisco $disco_1): void
    { $this->disco_1 = $disco_1; }

    public function setDisco2(EDisco $disco_2): void
    { $this->disco_2 = $disco_2; }

    public function setDisco3(EDisco $disco_3): void
    { $this->disco_3 = $disco_3; }

    public function setVotiDisco1(int $voti_disco_1): void
    { $this->voti_disco_1 = $voti_disco_1; }

    public function setVotiDisco2(int $voti_disco_2): void
    { $this->voti_disco_2 = $voti_disco_2; }

    public function setVotiDisco3(int $voti_disco_3): void
    { $this->voti_disco_3 = $voti_disco_3; }

    public function setInCorso(bool $in_corso): void
    { $this->in_corso = $in_corso; }

    public function setData(string $data): void
    { $this->data = $data; }

    /** Altri metodi */

    public function aggiungi_voto(string $disco): bool {

        if ($this->getDisco1()->getID()==$disco){
            $this->voti_disco_1++;
            return true;
        }
        elseif ($this->getDisco2()->getID()==$disco){
            $this->voti_disco_2++;
            return true;
        }
        elseif ($this->getDisco3()->getID()==$disco){
            $this->voti_disco_3++;
            return true;
        }
        else return false;
    }
}