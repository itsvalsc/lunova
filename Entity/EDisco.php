<?php

/** La classe EDisco caratterizza il disco di un artista attraverso:
 * ID_disco: identificativo del disco
 * titolo: identifica il titolo del disco
 * autore: identifica l'autore del disco, ovvero l'artista
 * prezzo: identifica il prezzo del disco
 * descrizione: identifica le canzoni appartenenti al disco
 * genere: identifica il genere a cui appartiene il disco
 * quantità: indica il numero di dischi disponibili
 * EImmagine: identifica l'immagine di copertina del disco
 */

class EDisco{
	private string $ID_disco;
	private string $titolo;
	private string $autore;
	private float $prezzo;
	private string $descrizione;
	private string $genere;
    private int $quantita;
	private ?EImmagine $copertina;

	public function __construct(string $titol, string $aut, float $price, string $descriz, string $gen, ?EImmagine $img, int $q){

        $this->ID_disco = "D"  . random_int(0,1000);
		$this->titolo = $titol ;
		$this->autore = $aut ;
		$this->prezzo = $price ; 
		$this->descrizione = $descriz ;
		$this->genere = $gen ;
        $this->quantita = $q;
		$this->copertina = $img ;
    }

	/** metodi get */
    public function getID()
    { return($this->ID_disco);}

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

    public function getQta()
    { return($this->quantita);}

    public function getCopertina()
    { return($this->copertina);}

	/** metodi set */
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

    /** Altri metodi */

    /** metodo che serve a vedere la descrizione del disco(i.e. le canzoni)
     * tagliate quando è troppo lungo
     */
    public function getDescrtaglio()
    { $x= $this->descrizione;
        $p = substr($x,0,20);
        return("$p...");}
}

?>