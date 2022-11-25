<?php
/**
 * ok
 * @package Entity 
 */

class EDisco{
	private string $ID_disco;
	private string $titolo;
	private string $autore;
	private float $prezzo;
	private string $descrizione;
	private string $genere;
    private int $quantita;
	private $copertina;    //reinserire Eimmagine come tipo

	private $_commento = array();

	public function __construct(string $titol, string $aut, float $price, string $descriz, string $gen, $img, int $q){

        $this->ID_disco = "D"  . random_int(0,1000);
		$this->titolo = $titol ;
		$this->autore = $aut ;
		$this->prezzo = $price ; 
		$this->descrizione = $descriz ;
		$this->genere = $gen ;
        $this->quantita = $q;
		$this->copertina = $img ;

	}

	public function addCommento(Ecommento $commento){
		array_push($this->_commento, $commento);}

	public function  getCommenti(){
		$num=count($this->_commento);
		if ($num>1){
			return ($this->_commento);
		}
		else return "Non ci sono commenti";
		}



	//metodi get
    public function getID()
    { return($this->ID_disco);}

    public function getQta()
    { return($this->quantita);}

	public function getTitolo()
	{ return($this->titolo);}

	public function getAutore()
	{ return($this->autore);}

	public function getPrezzo()
	{ return($this->prezzo);}

	public function getDescrizione()
	{ return($this->descrizione);}

	public function getGenere()
	{ return($this->genere);}

	public function getCopertina()
	{ return($this->copertina);}



	//metodi set
    public function setID( string $id )
    { $this->ID_disco = $id ;}

	public function setTitolo( string $s )
	{ $this->titolo = $s ;}

	public function setAutore( string $a )
	{ $this->autore = $a ;}

	public function setPrezzo( float $p )
	{ $this->prezzo = $p ;}

	public function setDescrizione( string $d )
	{ $this->descrizione = $d ;}

	public function setGenere( string $g )
	{ $this->genere = $g ;}

	public function setCopertina( EImmagine $c )
	{ $this->copertina = $c ;}

}

?>