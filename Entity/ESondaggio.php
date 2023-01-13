<?php

class ESondaggio
{
    private string $id;
    private EDisco $disco_1;
    private int $voti_disco_1;
    private EDisco $disco_2;
    private int $voti_disco_2;
    private EDisco $disco_3;
    private int $voti_disco_3;
    private string $data;
    private bool $in_corso;


    /**
     *
     */
    public function __construct(EDisco $disco1,EDisco $disco2,EDisco $disco3,string $date){
        $this->id = "S"  . random_int(0,100);
        $this->disco_1 = $disco1;
        $this->disco_2 = $disco2;
        $this->disco_3 = $disco3;
        $this->data = $date;
        $this->in_corso = 0;
    }





    /**
     * @return bool
     */
    public function getInCorso(): bool
    {
        return $this->in_corso;
    }

    /**
     * @param bool $in_corso
     */
    public function setInCorso(bool $in_corso): void
    {
        $this->in_corso = $in_corso;
    }


    /**
     * @return int
     */
    public function getVotiDisco1(): int
    {
        return $this->voti_disco_1;
    }

    /**
     * @return int
     */
    public function getVotiDisco2(): int
    {
        return $this->voti_disco_2;
    }

    /**
     * @return int
     */
    public function getVotiDisco3(): int
    {
        return $this->voti_disco_3;
    }

    /**
     * @param int $voti_disco_1
     */
    public function setVotiDisco1(int $voti_disco_1): void
    {
        $this->voti_disco_1 = $voti_disco_1;
    }

    /**
     * @param int $voti_disco_2
     */
    public function setVotiDisco2(int $voti_disco_2): void
    {
        $this->voti_disco_2 = $voti_disco_2;
    }

    /**
     * @param int $voti_disco_3
     */
    public function setVotiDisco3(int $voti_disco_3): void
    {
        $this->voti_disco_3 = $voti_disco_3;
    }


    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return EDisco
     */
    public function getDisco1(): EDisco
    {
        return $this->disco_1;
    }

    /**
     * @return EDisco
     */
    public function getDisco2(): EDisco
    {
        return $this->disco_2;
    }

    /**
     * @return EDisco
     */
    public function getDisco3(): EDisco
    {
        return $this->disco_3;
    }

    /**
     * @return string
     */
    public function getData(): string
    {
        return $this->data;
    }

    /**
     * @param string $id
     */
    public function setId(string $id): void
    {
        $this->id = $id;
    }

    /**
     * @param EDisco $disco_1
     */
    public function setDisco1(EDisco $disco_1): void
    {
        $this->disco_1 = $disco_1;
    }

    /**
     * @param EDisco $disco_2
     */
    public function setDisco2(EDisco $disco_2): void
    {
        $this->disco_2 = $disco_2;
    }

    /**
     * @param EDisco $disco_3
     */
    public function setDisco3(EDisco $disco_3): void
    {
        $this->disco_3 = $disco_3;
    }

    /**
     * @param string $data
     */
    public function setData(string $data): void
    {
        $this->data = $data;
    }

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