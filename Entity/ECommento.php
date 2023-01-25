<?php
/**
 * TO BE CHECKED
 * @package Entity
 */
class ECommento
{
    /**
     * @AttributeType int
     */
    private string $id;
    /**
     * @AttributeType string
     */
    private string $testo;
    private string $id_app_disco;
    private string $id_app_pers;

    public function __construct(string $comm, string $idad, string $idap){

        $this->id = "P" . random_int(0, 1000) ;
        $this->testo = $comm ;
        $this->id_app_disco = $idad;
        $this->id_app_pers = $idap;
    }

    //metodi get
    public function getId()
    { return($this->id); }

    public function getTesto()
    { return($this->testo); }

    public function getIdAD()
    { return($this->id_app_disco); }

    public function getIdAP()
    { return($this->id_app_pers); }

    //metodi set
    public function setId( string $idc )
    { $this->id = $idc; }

    public function setTesto( string $comm )
    { $this->testo = $comm; }

    public function setIdAD( string $i )
    { $this->id_app_disco = $i; }

    public function setIdAP( stirng $p )
    { $this->id_app_pers = $p; }







}

	//get



	//set

?>